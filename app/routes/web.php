<?php
use App\Core\Middleware\Csrf;

// Optional: set a 404 handler
$router->set404(function () {
    http_response_code(404);
    echo "Page not found.";
});

// Home route (example)
$router->get('/', function() {
    $user = null;
    if (!empty($_SESSION['user_id'])) {
        $container = $GLOBALS['container'];
        $db = $container->get(\App\Core\Database::class);
        $userModel = new \App\Models\User($db);
        $user = $userModel->findById((int)$_SESSION['user_id']);
        if (!empty($_SESSION['user_id'])) {
        header('Location: /dashboard'); exit;
    }
    }
    include __DIR__ . '\..\Views\layout\home.php';
});


// Show register form
$router->get('/register', function () {
    $container = $GLOBALS['container'];
    $controller = $container->get(\App\Controllers\AuthController::class);
    $controller->showRegister();
});

// Handle register form submission
$router->post('/register', function () {
    $controller = $GLOBALS['container']->get(\App\Controllers\AuthController::class);
    $controller->register();
});

// Show login form
$router->get('/login', function () {
    $controller = $GLOBALS['container']->get(\App\Controllers\AuthController::class);
    $controller->showLogin();
});

// Handle login
$router->post('/login', function () {
    $controller = $GLOBALS['container']->get(\App\Controllers\AuthController::class);
    $controller->login();
});

// Logout
$router->get('/logout', function () {
    $controller = $GLOBALS['container']->get(\App\Controllers\AuthController::class);
    $controller->logout();
});

// Example protected route (requires login)
$router->get('/dashboard', function () {
    if (empty($_SESSION['user_id'])) {
        flash('error', 'You must login first.');
        header('Location: /login');
        exit;
    }
    // render a dashboard view or simple message
    $controller = $GLOBALS['container']->get(\App\Controllers\DashboardController::class);
    $controller->index();
});

// Password reset
$router->get('/password/forgot', function () {
    $GLOBALS['container']->get(\App\Controllers\PasswordController::class)->showRequestForm();
});
$router->post('/password/forgot', function () {
    $GLOBALS['container']->get(\App\Controllers\PasswordController::class)->sendReset();
});
$router->get('/password/reset/([a-zA-Z0-9_-]+)', function ($token) {
    $GLOBALS['container']->get(\App\Controllers\PasswordController::class)->showResetForm($token);
});
$router->post('/password/reset', function () {
    $GLOBALS['container']->get(\App\Controllers\PasswordController::class)->reset();
});

// Profile
$router->get('/profile', function () {
    $GLOBALS['container']->get(\App\Controllers\ProfileController::class)->show();
});
$router->get('/profile/edit', function () {
    $GLOBALS['container']->get(\App\Controllers\ProfileController::class)->edit();
});
$router->post('/profile/update', function () {
    $GLOBALS['container']->get(\App\Controllers\ProfileController::class)->update();
});
// Profile (show & edit)
$router->get('/profile', function() {
    require_auth();
    $controller = $GLOBALS['container']->get(\App\Controllers\ProfileController::class);
    $controller->show();
});

$router->get('/profile/edit', function() {
    require_auth();
    $controller = $GLOBALS['container']->get(\App\Controllers\ProfileController::class);
    $controller->edit();
});

$router->post('/profile/update', function() {
    require_auth();
    $controller = $GLOBALS['container']->get(\App\Controllers\ProfileController::class);
    $controller->update();
});
// Dashboard (protected)
$router->get('/dashboard', function() {
    require_auth();
    $controller = $GLOBALS['container']->get(\App\Controllers\DashboardController::class);
    $controller->index();
});
$router->get('/marketoverview', function() {
    require_auth();
    $controller = $GLOBALS['container']->get(\App\Controllers\MarketOverviewController::class);
    $controller->index();
});

