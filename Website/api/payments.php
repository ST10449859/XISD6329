<?php
require_once __DIR__.'/bootstrap.php';
requireMethod('GET'); $user=requireUser();
try {
    $q=db()->prepare("
        SELECT p.id,p.amount,p.payment_method,p.status,p.reference_code,p.created_at,
               m.start_date,m.end_date,mp.name AS plan_name
        FROM payments p JOIN memberships m ON m.id=p.membership_id
        JOIN membership_plans mp ON mp.id=m.plan_id
        WHERE p.user_id=? ORDER BY p.created_at DESC
    ");
    $q->execute([$user['id']]); $rows=$q->fetchAll();
    respond(200,['success'=>true,'payments'=>$rows,'count'=>count($rows)]);
} catch(Throwable $e) { apiError($e,'Payments API'); }
