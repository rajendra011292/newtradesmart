<?php
namespace App\Core\Middleware;

/**
 * Simple CSRF token helper.
 *
 * - generateToken(): creates a token stored in session (if missing)
 * - inputField(): returns hidden input tag for forms
 * - validateToken($token): checks token validity
 *
 * Notes:
 * - Ensure sessions are started (secure_session_settings() in helpers).
 * - Tokens use hash_equals to avoid timing attacks.
 */
class Csrf
{
    // Session key
    protected const KEY = 'csrf_token';

    /**
     * Ensure a token exists and return it.
     */
    public static function generateToken(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION[self::KEY])) {
            // 32 bytes = 64 hex chars
            $_SESSION[self::KEY] = bin2hex(random_bytes(32));
        }

        return $_SESSION[self::KEY];
    }

    /**
     * Return a hidden input for forms.
     */
    public static function inputField(): string
    {
        $token = self::generateToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    /**
     * Validate a supplied token. Returns true when valid.
     */
    public static function validateToken(?string $token): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($token) || empty($_SESSION[self::KEY])) {
            return false;
        }

        // Use hash_equals to prevent timing attacks
        return hash_equals($_SESSION[self::KEY], $token);
    }

    /**
     * Optional: invalidate token (force regeneration next time).
     */
    public static function invalidate(): void
    {
        unset($_SESSION[self::KEY]);
    }
}
