<?php
declare(strict_types=1);

// ----------------------------------------------------
// public/index.php (patched)
// Front controller: loads services, container, and routes
// ----------------------------------------------------

// 1) Show errors in development (turn off in production)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// 2) Composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

// 3) Load environment (.env) - ensure .env exists at project root
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load(); // you created .env earlier

// 4) Helpers (secure_session_settings, flash, old, etc.)
// If helpers are autoloaded via composer "files", this is safe to skip.
// We include it defensively so dev setups work without composer-files.
$helpers = __DIR__ . '/../app/helpers/functions.php';
if (file_exists($helpers)) {
    require_once $helpers;
}

// 5) Start secure session
if (function_exists('secure_session_settings')) {
    secure_session_settings();
} else {
    // fallback minimal session start
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// 6) Bootstrap core (creates $GLOBALS['container'], binds Database, Config, Mailer, etc.)
require_once __DIR__ . '/../app/Core/bootstrap.php';

// 7) Create router
$router = new \Bramus\Router\Router();

// 8) Optionally set a 404 handler here (can be in routes file too)
$router->set404(function() {
    http_response_code(404);
    echo "Page not found.";
});

// 9) Load routes (move route definitions out of this file)
$routesFile = __DIR__ . '/../app/routes/web.php';
if (file_exists($routesFile)) {
    require_once $routesFile;
} else {
    // fail-fast helpful message in dev
    if ($_ENV['APP_ENV'] ?? 'production' === 'development') {
        echo "Routes file not found: {$routesFile}";
        exit;
    } else {
        http_response_code(500);
        echo "Server configuration error.";
        exit;
    }
}

// 10) Run router (dispatch)
$router->run();
