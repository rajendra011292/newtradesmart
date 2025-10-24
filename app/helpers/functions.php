<?php
// app/helpers/functions.php
// Small, safe helper utilities used by the app.

// Start a secure session (call once early: index.php)
function secure_session_settings(): void {
    if (session_status() === PHP_SESSION_NONE) {
        // Configure cookie params before calling session_start()
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'] ?? '',
            'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        session_start();
    }
}

// Flash messages: set or get (consumes stored message)
function flash(string $key, ?string $message = null) {
    if ($message === null) {
        if (isset($_SESSION['flash'][$key])) {
            $val = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $val;
        }
        return null;
    }
    $_SESSION['flash'][$key] = $message;
    return null;
}

// Old input helpers (for repopulating forms)
function old(string $key, $default = '') {
    return $_SESSION['old'][$key] ?? $default;
}

function set_old(array $data): void {
    $_SESSION['old'] = $data;
}

// Simple HTML escape helper
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Simple auth check
function is_logged_in(): bool {
    return !empty($_SESSION['user_id']);
}

// Redirect helper
function redirect(string $path): void {
    header('Location: ' . $path);
    exit;
}
