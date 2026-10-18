<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params(['httponly'=>true, 'secure'=>isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off', 'samesite'=>'Lax']);
    session_start();
}
define('APP_NAME', 'CampusConnect Student Portal');
$host = getenv('DB_HOST') ?: 'localhost';
$db = getenv('DB_NAME') ?: 'student_portal';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: '';
try {
    $pdo = new PDO("mysql:host={$host};dbname={$db};charset=utf8mb4", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES=>false,
    ]);
} catch (PDOException $e) {
    error_log('Database connection failed: '.$e->getMessage());
    http_response_code(500);
    exit('Unable to connect to the database. Check config/config.php and database setup.');
}
