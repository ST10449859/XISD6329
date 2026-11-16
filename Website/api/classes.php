<?php
require_once __DIR__.'/bootstrap.php';
requireMethod('GET');
try {
    $stmt=db()->query("
        SELECT c.id,c.title AS class_name,c.description,c.class_date,c.start_time,c.end_time,
               c.capacity,t.full_name AS trainer_name,
               GREATEST(c.capacity-COUNT(b.id),0) AS spaces_available
        FROM classes c
        LEFT JOIN trainers t ON t.id=c.trainer_id
        LEFT JOIN bookings b ON b.class_id=c.id AND b.status='booked'
        WHERE c.active=1 AND c.class_date>=CURDATE()
        GROUP BY c.id,t.full_name
        ORDER BY c.class_date,c.start_time
    ");
    $classes=$stmt->fetchAll();
    respond(200,['success'=>true,'classes'=>$classes,'count'=>count($classes)]);
} catch(Throwable $e) { apiError($e,'Classes API'); }
