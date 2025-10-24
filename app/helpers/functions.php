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

// call this at top of routes or inside route closures/controllers
function require_auth(): void {
    if (empty($_SESSION['user_id'])) {
        flash('error','You must log in.');
        header('Location: /login'); exit;
    }
}

function require_admin(): void {
    require_auth();
    // simple role check — adjust according to your user model
    $db = $GLOBALS['container']->get(\App\Core\Database::class);
    $user = (new \App\Models\User($db))->findById((int)$_SESSION['user_id']);
    if (empty($user) || ($user['role'] ?? '') !== 'admin') {
        http_response_code(403);
        echo "Forbidden";
        exit;
    }
}
function render(string $viewPath, array $data = [], string $title = 'TradeSmart'): void {
    extract($data); // make keys into variables
    ob_start();
    require __DIR__ . '/../Views/' . ltrim($viewPath, '/');
    $content = ob_get_clean();
    require __DIR__ . '/../Views/layout/main.php';
}
function renderAuth(string $viewPath, array $data = [], string $title = 'TradeSmart'): void {
    extract($data); // make keys into variables
    
    // Ensure the view path has a .php extension
    $viewFile = __DIR__ . '/../Views/' . ltrim($viewPath, '/');
    if (!str_ends_with($viewFile, '.php')) {
        $viewFile .= '.php';
    }
    
    // Start output buffering
    ob_start();
    
    // Include the view file
    if (!file_exists($viewFile)) {
        throw new Exception("View file not found: " . $viewFile);
    }
    
    require $viewFile;
    $content = ob_get_clean();
    
    // Include the layout
    require __DIR__ . '/../Views/auth/_auth_layout.php';
}


