<?php
namespace App\Core;

use PDO;
use PDOException;

/**
 * Database connection wrapper using PDO.
 * Provides helper methods for running queries safely.
 */
class Database
{
    private PDO $pdo;

    /**
     * Construct a new Database connection.
     *
     * @throws PDOException if connection fails
     */
    public function __construct(
        string $host,
        string $name,
        string $user,
        string $pass,
        int $port = 3306
    ) {
        $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    /** Get raw PDO instance. */
    public function pdo(): PDO
    {
        return $this->pdo;
    }

    /** Run a prepared statement (shortcut). */
    public function run(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /** Fetch a single row. */
    public function fetchOne(string $sql, array $params = []): ?array
    {
        $stmt = $this->run($sql, $params);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Fetch all rows. */
    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->run($sql, $params)->fetchAll();
    }

    /** Transaction helpers. */
    public function beginTransaction(): bool { return $this->pdo->beginTransaction(); }
    public function commit(): bool { return $this->pdo->commit(); }
    public function rollBack(): bool { return $this->pdo->rollBack(); }
}
