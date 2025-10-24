<?php
// app/Core/bootstrap.php
// Bootstraps core services: DI container, Database singleton, Config, etc.

use App\Core\Container;
use App\Core\Database;
use App\Core\Config; // optional — see note below

// Create container
$container = new Container();

// Bind Database as singleton so all classes share the same PDO instance
$container->singleton(Database::class, function ($c) {
    // read database settings from environment with sane defaults
    $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
    $name = $_ENV['DB_NAME'] ?? 'tradesmart_db';
    $user = $_ENV['DB_USER'] ?? 'root';
    $pass = $_ENV['DB_PASS'] ?? '';
    $port = isset($_ENV['DB_PORT']) ? (int) $_ENV['DB_PORT'] : 3306;

    return new Database($host, $name, $user, $pass, $port);
});

// Optional short alias 'db' for convenience
$container->singleton('db', function ($c) {
    return $c->get(Database::class);
});

// Bind a simple Config object/array so you can inject app settings
// If you have a Config class (recommended), use that; otherwise we bind an array.
$configArray = [
    'app_name'  => $_ENV['APP_NAME'] ?? 'TradeSmart',
    'env'       => $_ENV['APP_ENV'] ?? 'production',
    'debug'     => filter_var($_ENV['APP_DEBUG'] ?? 'false', FILTER_VALIDATE_BOOLEAN),
    'base_url'  => $_ENV['BASE_URL'] ?? '',
];

$container->singleton('config', function ($c) use ($configArray) {
    // If you created App\Core\Config class, return new Config($configArray);
    // Otherwise simply return the array:
    return $configArray;
});

// Example: bind a logger, mailer, or other services here if you add them later
// $container->singleton(App\Services\Logger::class, function($c) { ... });

// Expose container globally for simple access in routes (learning convenience).
// In production you might pass $container explicitly to the router instead.
$GLOBALS['container'] = $container;

// Helper: optionally provide a shortcut $app for routing files
$GLOBALS['app'] = [
    'container' => $container,
    'config' => $container->get('config'),
];
