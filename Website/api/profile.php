<?php
require_once __DIR__.'/bootstrap.php';
$user=requireUser(); $method=strtoupper($_SERVER['REQUEST_METHOD'] ?? '');
try {
    if ($method==='GET') respond(200,['success'=>true,'user'=>$user]);
    if ($method==='PUT') {
        $d=readJson(); $name=trim((string)($d['full_name'] ?? '')); $phone=trim((string)($d['phone'] ?? ''));
        if ($name==='' || mb_strlen($name)>100) respond(400,['success'=>false,'message'=>'Enter a valid full name.']);
        if (mb_strlen($phone)>30) respond(400,['success'=>false,'message'=>'Phone number is too long.']);
        db()->prepare('UPDATE users SET full_name=?,phone=? WHERE id=?')->execute([$name,$phone ?: null,$user['id']]);
        $q=db()->prepare('SELECT id,full_name,email,phone,role FROM users WHERE id=?'); $q->execute([$user['id']]);
        respond(200,['success'=>true,'message'=>'Profile updated.','user'=>$q->fetch()]);
    }
    header('Allow: GET, PUT'); respond(405,['success'=>false,'message'=>'Use GET or PUT.']);
} catch(Throwable $e) { apiError($e,'Profile API'); }
