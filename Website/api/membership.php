<?php
require_once __DIR__.'/bootstrap.php';
requireMethod('GET'); $user=requireUser();
try {
    $pdo=db();
    $pdo->prepare('INSERT IGNORE INTO user_settings(user_id) VALUES(?)')->execute([$user['id']]);
    $q=$pdo->prepare("
        SELECT m.id AS membership_id,m.start_date,m.end_date,m.status,
               p.id AS plan_id,p.name AS plan_name,p.description AS plan_description,
               p.price AS monthly_price,p.duration_days
        FROM memberships m JOIN membership_plans p ON p.id=m.plan_id
        WHERE m.user_id=? ORDER BY m.id DESC LIMIT 1
    ");
    $q->execute([$user['id']]); $membership=$q->fetch();
    respond(200,['success'=>true,'message'=>$membership?'Membership retrieved.':'No membership found.','membership'=>$membership ?: null]);
} catch(Throwable $e) { apiError($e,'Membership API'); }
