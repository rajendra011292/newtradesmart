<?php
declare(strict_types=1);

// ----------------------------------------------------
// public/index.php
// Front controller for TradeSmart (PSR-4 + DI container)
// ----------------------------------------------------

// 1) Show errors in development (turn off in production)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// 2) Autoload (Composer) - this also loads app/helpers/functions.php if configured in composer.json 'files'
require_once __DIR__ . '/../vendor/autoload.php';

// 3) Load environment (.env) - ensure .env exists at project root
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load(); // you created .env, so load() is appropriate

// 4) Start secure session (helper from app/helpers/functions.php)
if (!function_exists('secure_session_settings')) {
    // If you didn't autoload helpers via composer 'files', require them manually:
    require_once __DIR__ . '/../app/helpers/functions.php';
}
secure_session_settings();

// 5) Bootstrap core (creates & binds container, database, config, etc.)
require_once __DIR__ . '/../app/Core/bootstrap.php';

// 6) Create router (Bramus) and define routes
$router = new \Bramus\Router\Router();

// Optional: set a 404 handler
$router->set404(function() {
    http_response_code(404);
    echo "Page not found.";
});

// Home route (example)
$router->get('/', function() {
    // simple home page — you can render a view instead
    if (!empty($_SESSION['user_id'])) {
        echo "Welcome, user #" . intval($_SESSION['user_id']) . " — <a href='/logout'>Logout</a>";
    } else {
        echo "Welcome to TradeSmart — <a href='/login'>Login</a> | <a href='/register'>Register</a>";
    }
});

// Show register form
$router->get('/register', function() {
    $container = $GLOBALS['container'];
    $controller = $container->get(\App\Controllers\AuthController::class);
    $controller->showRegister();
});

// Handle register form submission
$router->post('/register', function() {
    $controller = $GLOBALS['container']->get(\App\Controllers\AuthController::class);
    $controller->register();
});

// Show login form
$router->get('/login', function() {
    $controller = $GLOBALS['container']->get(\App\Controllers\AuthController::class);
    $controller->showLogin();
});

// Handle login
$router->post('/login', function() {
    $controller = $GLOBALS['container']->get(\App\Controllers\AuthController::class);
    $controller->login();
});

// Logout
$router->get('/logout', function() {
    $controller = $GLOBALS['container']->get(\App\Controllers\AuthController::class);
    $controller->logout();
});

// Example protected route (requires login)
$router->get('/dashboard', function() {
    if (empty($_SESSION['user_id'])) {
        flash('error', 'You must login first.');
        header('Location: /login');
        exit;
    }
    // render a dashboard view or simple message
    echo "Dashboard — protected content for user #" . intval($_SESSION['user_id']);
});

// 7) Dispatch the router
$router->run();
