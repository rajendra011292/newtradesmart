<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
require_once __DIR__ . '/../app/Core/Database.php';

use App\Core\Database;

try {
    $db = new Database(
        $_ENV['DB_HOST'],
        $_ENV['DB_NAME'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS']
    );

    $stmt = $db->pdo()->query("SELECT COUNT(*) AS total FROM users");
    $row = $stmt->fetch();
    echo "✅ DB connected! Users table rows: " . $row['total'];
} catch (Exception $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
