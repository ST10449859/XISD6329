<?php
require_once __DIR__.'/bootstrap.php';
requireMethod('GET');
try {
    $rows=db()->query('SELECT id,full_name,specialty,bio FROM trainers ORDER BY full_name')->fetchAll();
    respond(200,['success'=>true,'trainers'=>$rows,'count'=>count($rows)]);
} catch(Throwable $e) { apiError($e,'Trainers API'); }
