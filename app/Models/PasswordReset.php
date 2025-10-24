<?php
namespace App\Models;
use App\Core\Database;

class PasswordReset {
    private Database $db;
    public function __construct(Database $db) { $this->db = $db; }

    public function create(string $email, string $token): bool {
        // optionally delete previous tokens for this email
        $this->db->run("DELETE FROM password_resets WHERE email = :email", [':email'=>$email]);
        $this->db->run("INSERT INTO password_resets (email, token, created_at) VALUES (:email, :token, NOW())", [':email'=>$email, ':token'=>$token]);
        return true;
    }

    public function findByToken(string $token): ?array {
        return $this->db->fetchOne("SELECT * FROM password_resets WHERE token = :token LIMIT 1", [':token'=>$token]);
    }

    public function deleteByEmail(string $email): void {
        $this->db->run("DELETE FROM password_resets WHERE email = :email", [':email'=>$email]);
    }

    public function deleteByToken(string $token): void {
        $this->db->run("DELETE FROM password_resets WHERE token = :token", [':token'=>$token]);
    }
}
