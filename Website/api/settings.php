<?php
require_once __DIR__.'/bootstrap.php';
$user=requireUser(); $method=strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
try {
    $pdo=db(); $pdo->prepare('INSERT IGNORE INTO user_settings(user_id) VALUES(?)')->execute([$user['id']]);
    if ($method==='GET') {
        $q=$pdo->prepare('SELECT user_id,theme,notifications_enabled,language,updated_at FROM user_settings WHERE user_id=?');
        $q->execute([$user['id']]); respond(200,['success'=>true,'settings'=>$q->fetch()]);
    }
    if ($method==='PUT') {
        $d=readJson(); $sets=[]; $vals=[];
        if (array_key_exists('theme',$d)) {
            if (!in_array($d['theme'],['light','dark'],true)) respond(400,['success'=>false,'message'=>'Theme must be light or dark.']);
            $sets[]='theme=?'; $vals[]=$d['theme'];
        }
        if (array_key_exists('notifications_enabled',$d)) {
            if (!in_array($d['notifications_enabled'],[0,1,'0','1',false,true],true)) respond(400,['success'=>false,'message'=>'Invalid notification preference.']);
            $sets[]='notifications_enabled=?'; $vals[]=(int)$d['notifications_enabled'];
        }
        if (array_key_exists('language',$d)) {
            if (!in_array($d['language'],['en','af','zu'],true)) respond(400,['success'=>false,'message'=>'Language must be en, af or zu.']);
            $sets[]='language=?'; $vals[]=$d['language'];
        }
        if (!$sets) respond(400,['success'=>false,'message'=>'No settings were provided.']);
        $vals[]=$user['id']; $pdo->prepare('UPDATE user_settings SET '.implode(',',$sets).' WHERE user_id=?')->execute($vals);
        $q=$pdo->prepare('SELECT user_id,theme,notifications_enabled,language,updated_at FROM user_settings WHERE user_id=?');
        $q->execute([$user['id']]); respond(200,['success'=>true,'message'=>'Settings saved.','settings'=>$q->fetch()]);
    }
    header('Allow: GET, PUT'); respond(405,['success'=>false,'message'=>'Use GET or PUT.']);
} catch(Throwable $e) { apiError($e,'Settings API'); }
