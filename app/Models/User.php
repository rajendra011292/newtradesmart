<?php
namespace App\Models;

use App\Core\Database;
use PDOException;

class User
{
    private Database $db;

    /**
     * Inject Database (via DI container).
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Create a new user.
     *
     * @return int Inserted user ID
     * @throws \Exception on failure
     */
    public function create(string $name, string $email, string $password): int
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, created_at, updated_at)
                VALUES (:name, :email, :password, NOW(), NOW())";

        try {
            $this->db->run($sql, [
                ':name'     => $name,
                ':email'    => $email,
                ':password' => $hash
            ]);

            return (int) $this->db->pdo()->lastInsertId();
        } catch (PDOException $e) {
            // You may want to log $e->getMessage() in real app
            throw new \Exception('Failed to create user: ' . $e->getMessage());
        }
    }

    /**
     * Find a user by email.
     *
     * @return array|null User row or null if not found
     */
    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT id, name, email, password, role, is_active, created_at, updated_at
                FROM users
                WHERE email = :email
                LIMIT 1";

        return $this->db->fetchOne($sql, [':email' => $email]);
    }

    /**
     * Find a user by id.
     *
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT id, name, email, password, role, is_active, created_at, updated_at
                FROM users
                WHERE id = :id
                LIMIT 1";

        return $this->db->fetchOne($sql, [':id' => $id]);
    }

    /**
     * Update user's password (use when rehashing).
     *
     * @return bool true on success
     */
    public function updatePassword(int $id, string $newHash): bool
    {
        $sql = "UPDATE users SET password = :password, updated_at = NOW() WHERE id = :id";
        try {
            $stmt = $this->db->run($sql, [':password' => $newHash, ':id' => $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // log if needed
            return false;
        }
    }
}
