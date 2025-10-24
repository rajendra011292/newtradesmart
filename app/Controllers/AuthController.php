<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\Database;
use App\Core\Middleware\Csrf;

class AuthController
{
    private User $userModel;

    /**
     * The container will automatically inject Database
     * when it builds this controller.
     */
    public function __construct(Database $db)
    {
        // Inject Database into the User model
        $this->userModel = new User($db);
    }

    /**
     * Show the registration form
     */
    public function showRegister(): void
    {
        $data = [
            'title' => 'Sign Up',
            'heading' => 'Sign up to your account',
            'subheading' => 'Enter your credentials to access your dashboard',
            'show_login_link' => true,
            'show_forgot_link' => true
        ];
        renderAuth('auth/register', $data);
    }

    /**
     * Handle registration form submission
     */
    public function register(): void
    {
        // Validate CSRF token
        if (!Csrf::validateToken($_POST['csrf_token'] ?? null)) {
            flash('error', 'Invalid request (CSRF). Please try again.');
            redirect('/register');
        }

        $name = trim($_POST['name'] ?? '');
        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['password_confirm'] ?? '';

        set_old(['name' => $name, 'email' => $email]);

        // Validation
        $errors = [];
        if ($name === '') $errors[] = 'Name is required.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
        if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';
        if ($password !== $confirm) $errors[] = 'Passwords do not match.';

        if (!empty($errors)) {
            flash('error', implode('<br>', $errors));
            redirect('/register');
        }

        // Check if user already exists
        if ($this->userModel->findByEmail($email)) {
            flash('error', 'Email already registered.');
            redirect('/register');
        }

        // Create new user
        $id = $this->userModel->create($name, $email, $password);

        session_regenerate_id(true);
        $_SESSION['user_id'] = $id;

        flash('success', 'Registration successful! You are now logged in.');
        redirect('/');
    }

    /**
     * Show the login form
     */
    public function showLogin(): void
    {
        $data = [
            'title' => 'Sign In',
            'heading' => 'Sign in to your account',
            'subheading' => 'Enter your credentials to access your dashboard',
            'show_register_link' => true,
            'show_forgot_link' => true
        ];
        renderAuth('auth/login', $data);
    }

    /**
     * Handle login form submission
     */
    public function login(): void
    {
        if (!Csrf::validateToken($_POST['csrf_token'] ?? null)) {
            flash('error', 'Invalid request (CSRF).');
            redirect('/login');
        }

        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        set_old(['email' => $email]);

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            flash('error', 'Invalid credentials.');
            redirect('/login');
        }

        // Optional: rehash outdated password hashes
        if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $this->userModel->updatePassword($user['id'], $newHash);
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];

        flash('success', 'Welcome back!');
        redirect('/');
    }

    /**
     * Logout and destroy session
     */
    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }

        session_destroy();
        redirect('/login');
    }
}
