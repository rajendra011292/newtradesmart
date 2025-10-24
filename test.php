<?php
declare(strict_types=1);

// ----------------------------------------------------
// public/index.php
// Front controller: every HTTP request goes through here
// ----------------------------------------------------

// 1) Development error settings (disable for production)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// 2) Autoload Composer packages & your app (PSR-4)
require_once __DIR__ . '/../vendor/autoload.php';

\App\Core\Test::sayHello();

// 3) Load helper functions (small utils used app-wide)
require_once __DIR__ . '/../app/helpers/functions.php';

// 4) Load .env config
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// 5) Start a secure session (helper below handles cookie flags)
secure_session_settings();

// 6) Bootstrap core services (DB connection, app container, etc.)
//    Keep this short — move heavy lifting into app/core/bootstrap.php
require_once __DIR__ . '/../app/core/bootstrap.php';

// 7) Create / configure router (example uses Bramus Router)
$router = new \Bramus\Router\Router();

// 8) Define routes (keep route definitions in a separate file)
require_once __DIR__ . '/../app/routes/web.php';

// 9) Run router — dispatch request to controller
$router->run();

