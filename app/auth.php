<?php
// Atur cookie session lebih aman (set sebelum session_start)
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => false,      // true bila sudah HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
require_once __DIR__ . '/init.php';

// Seed CSRF token
if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

if (!isset($_SESSION['user']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit;
}
