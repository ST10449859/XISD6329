<?php
require_once __DIR__.'/bootstrap.php';
$user=requireUser(); $method=strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
try {
    if ($method==='GET') {
        $q=db()->prepare('SELECT id,title,message,is_read,created_at FROM notifications WHERE user_id=? ORDER BY created_at DESC');
        $q->execute([$user['id']]); $rows=$q->fetchAll();
        respond(200,['success'=>true,'notifications'=>$rows,'count'=>count($rows)]);
    }
    if ($method==='POST') {
        $data=readJson(); $id=filter_var($data['notification_id'] ?? null,FILTER_VALIDATE_INT);
        if (!$id || $id<1) respond(400,['success'=>false,'message'=>'A valid notification is required.']);
        $q=db()->prepare('UPDATE notifications SET is_read=1 WHERE id=? AND user_id=?');
        $q->execute([$id,$user['id']]);
        if (!$q->rowCount()) respond(404,['success'=>false,'message'=>'Notification not found or already read.']);
        respond(200,['success'=>true,'message'=>'Notification marked as read.']);
    }
    header('Allow: GET, POST'); respond(405,['success'=>false,'message'=>'Use GET or POST.']);
} catch(Throwable $e) { apiError($e,'Notifications API'); }
