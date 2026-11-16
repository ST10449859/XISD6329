<?php
require_once __DIR__.'/bootstrap.php';
requireMethod('POST');
$data = readJson();
$action = $data['action'] ?? '';
try {
    $pdo = db();
    if ($action === 'register') {
        $name = trim((string)($data['full_name'] ?? ''));
        $email = strtolower(trim((string)($data['email'] ?? '')));
        $password = (string)($data['password'] ?? '');
        if ($name === '' || mb_strlen($name) > 100) respond(400,['success'=>false,'message'=>'Enter your full name (maximum 100 characters).']);
        if (!filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($email)>150) respond(400,['success'=>false,'message'=>'Enter a valid email address.']);
        if (strlen($password)<8) respond(400,['success'=>false,'message'=>'Password must contain at least 8 characters.']);
        $stmt=$pdo->prepare('INSERT INTO users(full_name,email,password_hash,role) VALUES(?,?,?,\'member\')');
        try { $stmt->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT)]); }
        catch(PDOException $e) { if (($e->errorInfo[1] ?? 0)===1062) respond(409,['success'=>false,'message'=>'An account with this email already exists.']); throw $e; }
        $id=(int)$pdo->lastInsertId();
        $pdo->prepare('INSERT INTO user_settings(user_id) VALUES(?)')->execute([$id]);
        respond(201,['success'=>true,'message'=>'Account created. You can now sign in.']);
    }
    if ($action === 'login') {
        $email=strtolower(trim((string)($data['email'] ?? '')));
        $password=(string)($data['password'] ?? '');
        $stmt=$pdo->prepare('SELECT id,full_name,email,password_hash,role FROM users WHERE email=? LIMIT 1');
        $stmt->execute([$email]); $row=$stmt->fetch();
        if (!$row || !password_verify($password,$row['password_hash'])) respond(401,['success'=>false,'message'=>'Email or password is incorrect.']);
        $token=bin2hex(random_bytes(32));
        $pdo->prepare('DELETE FROM api_tokens WHERE user_id=? AND expires_at<=NOW()')->execute([$row['id']]);
        $pdo->prepare('INSERT INTO api_tokens(user_id,token_hash,expires_at) VALUES(?,?,DATE_ADD(NOW(),INTERVAL 24 HOUR))')
            ->execute([$row['id'],hash('sha256',$token)]);
        unset($row['password_hash']);
        respond(200,['success'=>true,'message'=>'Signed in successfully.','token'=>$token,'user'=>$row]);
    }
    respond(400,['success'=>false,'message'=>'Unknown authentication action.']);
} catch(Throwable $e) { apiError($e,'Authentication API'); }
