<?php
require_once __DIR__.'/bootstrap.php';
requireMethod('POST');
$user=requireUser(); $token=bearerToken();
try {
    db()->prepare('DELETE FROM api_tokens WHERE user_id=? AND token_hash=?')->execute([$user['id'],hash('sha256',$token)]);
    respond(200,['success'=>true,'message'=>'Signed out successfully.']);
} catch(Throwable $e) { apiError($e,'Logout API'); }
