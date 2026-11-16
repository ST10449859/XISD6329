<?php
require_once __DIR__.'/bootstrap.php';
$user=requireUser(); $method=strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
try {
    $pdo=db();
    if ($method==='GET') {
        $stmt=$pdo->prepare("
            SELECT b.id AS booking_id,b.class_id,b.status,b.booked_at,
                   c.title AS class_name,c.description,c.class_date,c.start_time,c.end_time,
                   t.full_name AS trainer_name
            FROM bookings b JOIN classes c ON c.id=b.class_id
            LEFT JOIN trainers t ON t.id=c.trainer_id
            WHERE b.user_id=? ORDER BY c.class_date DESC,c.start_time DESC
        ");
        $stmt->execute([$user['id']]); $rows=$stmt->fetchAll();
        respond(200,['success'=>true,'bookings'=>$rows,'count'=>count($rows)]);
    }
    if ($method==='POST') {
        $data=readJson(); $action=$data['action'] ?? '';
        if ($action==='book') {
            $classId=filter_var($data['class_id'] ?? null,FILTER_VALIDATE_INT);
            if (!$classId || $classId<1) respond(400,['success'=>false,'message'=>'A valid class is required.']);
            $pdo->beginTransaction();
            $q=$pdo->prepare('SELECT id,capacity,class_date,active FROM classes WHERE id=? FOR UPDATE');
            $q->execute([$classId]); $class=$q->fetch();
            if (!$class || !(int)$class['active'] || $class['class_date']<date('Y-m-d')) {
                $pdo->rollBack(); respond(404,['success'=>false,'message'=>'This class is unavailable.']);
            }
            $q=$pdo->prepare('SELECT id,status FROM bookings WHERE user_id=? AND class_id=? LIMIT 1');
            $q->execute([$user['id'],$classId]); $old=$q->fetch();
            if ($old && $old['status']==='booked') {
                $pdo->rollBack(); respond(409,['success'=>false,'message'=>'You have already booked this class.']);
            }
            $q=$pdo->prepare("SELECT COUNT(*) FROM bookings WHERE class_id=? AND status='booked'");
            $q->execute([$classId]);
            if ((int)$q->fetchColumn()>=(int)$class['capacity']) {
                $pdo->rollBack(); respond(409,['success'=>false,'message'=>'This class is fully booked.']);
            }
            if ($old) {
                $pdo->prepare("UPDATE bookings SET status='booked',booked_at=NOW() WHERE id=?")->execute([$old['id']]);
            } else {
                $pdo->prepare("INSERT INTO bookings(user_id,class_id,status) VALUES(?,?,'booked')")->execute([$user['id'],$classId]);
            }
            $pdo->commit(); respond(201,['success'=>true,'message'=>'Your class has been booked.']);
        }
        if ($action==='cancel') {
            $id=filter_var($data['booking_id'] ?? null,FILTER_VALIDATE_INT);
            if (!$id || $id<1) respond(400,['success'=>false,'message'=>'A valid booking is required.']);
            $q=$pdo->prepare("UPDATE bookings SET status='cancelled' WHERE id=? AND user_id=? AND status='booked'");
            $q->execute([$id,$user['id']]);
            if (!$q->rowCount()) respond(404,['success'=>false,'message'=>'Booking not found or already cancelled.']);
            respond(200,['success'=>true,'message'=>'Booking cancelled.']);
        }
        respond(400,['success'=>false,'message'=>'Action must be book or cancel.']);
    }
    header('Allow: GET, POST'); respond(405,['success'=>false,'message'=>'Use GET or POST.']);
} catch(Throwable $e) {
    if (isset($pdo) && $pdo->inTransaction()) $pdo->rollBack();
    apiError($e,'Bookings API');
}
