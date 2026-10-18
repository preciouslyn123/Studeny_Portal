<?php
declare(strict_types=1);
function e(?string $value): string { return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function redirect(string $path): never { header('Location: '.$path); exit; }
function current_user(): ?array { return $_SESSION['user'] ?? null; }
function require_login(): void {
    if (!current_user()) { set_flash('warning', 'Please sign in to continue.'); $script = (string)($_SERVER['SCRIPT_NAME'] ?? ''); redirect((str_contains($script, '/admin/') || str_contains($script, '/student/')) ? '../login.php' : 'login.php'); }
}
function require_role(string $role): void {
    require_login();
    if ((current_user()['role'] ?? '') !== $role) { http_response_code(403); exit('403 Forbidden: You do not have permission to view this page.'); }
}
function csrf_token(): string { if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); return $_SESSION['csrf_token']; }
function verify_csrf(): void {
    $sent = $_POST['csrf_token'] ?? '';
    if (!is_string($sent) || !hash_equals(csrf_token(), $sent)) { http_response_code(419); exit('Your form expired. Please go back and try again.'); }
}
function set_flash(string $type, string $message): void { $_SESSION['flash'] = ['type'=>$type, 'message'=>$message]; }
function get_flash(): ?array { $flash = $_SESSION['flash'] ?? null; unset($_SESSION['flash']); return $flash; }
function valid_email(string $email): bool { return (bool)filter_var($email, FILTER_VALIDATE_EMAIL); }
function valid_student_number(string $number): bool { return (bool)preg_match('/^[A-Za-z0-9-]{3,30}$/', $number); }
