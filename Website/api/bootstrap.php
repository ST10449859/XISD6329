<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

function respond(int $status, array $payload): never {
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}
function requireMethod(string ...$allowed): void {
    $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    if (!in_array($method, $allowed, true)) {
        header('Allow: ' . implode(', ', $allowed));
        respond(405, ['success'=>false, 'message'=>'Method not allowed.']);
    }
}
function readJson(): array {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw ?: '{}', true);
    if (!is_array($data)) respond(400, ['success'=>false, 'message'=>'Invalid JSON request.']);
    return $data;
}
function bearerToken(): ?string {
    $header = $_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? '';
    if (!$header && function_exists('getallheaders')) {
        $headers = getallheaders();
        $header = $headers['Authorization'] ?? $headers['authorization'] ?? '';
    }
    return preg_match('/Bearer\s+([a-f0-9]{64})/i', $header, $m) ? $m[1] : null;
}
function requireUser(): array {
    $token = bearerToken();
    if (!$token) respond(401, ['success'=>false, 'message'=>'Please sign in to continue.']);
    try {
        $stmt = db()->prepare(
            'SELECT u.id, u.full_name, u.email, u.phone, u.role
             FROM api_tokens t JOIN users u ON u.id=t.user_id
             WHERE t.token_hash=? AND t.expires_at > NOW() LIMIT 1'
        );
        $stmt->execute([hash('sha256', $token)]);
        $user = $stmt->fetch();
        if (!$user) respond(401, ['success'=>false, 'message'=>'Your session has expired. Please sign in again.']);
        return $user;
    } catch (PDOException $e) {
        error_log('Authentication error: '.$e->getMessage());
        respond(500, ['success'=>false, 'message'=>'Authentication service unavailable.']);
    }
}
function requireRole(array $user, array $roles): void {
    if (!in_array($user['role'], $roles, true)) respond(403, ['success'=>false, 'message'=>'You do not have permission to perform this action.']);
}
function apiError(Throwable $e, string $label): never {
    error_log($label.': '.$e->getMessage());
    respond(500, ['success'=>false, 'message'=>'The request could not be completed. Please try again.']);
}
