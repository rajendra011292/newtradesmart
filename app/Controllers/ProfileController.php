<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\Middleware\Csrf;

class ProfileController
{
    private User $userModel;

    public function __construct(\App\Core\Database $db)
    {
        $this->userModel = new User($db);
    }

    // Show profile (read-only)
    public function show(): void
{
    $userId = $_SESSION['user_id'];
    $user = $this->userModel->findById($userId);
    render('profile/show.php', compact('user'), 'My Profile');
}


    // Show edit form
    public function edit(): void
    {
        $userId = (int) ($_SESSION['user_id'] ?? 0);
        if ($userId <= 0) {
            flash('error', 'You must login first.');
            redirect('/login');
        }
        $user = $this->userModel->findById($userId);
        include __DIR__ . '/../Views/profile/edit.php';
    }

    // Handle update (name, bio, location, avatar upload)
    public function update(): void
    {
        if (!Csrf::validateToken($_POST['csrf_token'] ?? null)) {
            flash('error', 'Invalid CSRF token.');
            redirect('/profile/edit');
        }

        $userId = (int) ($_SESSION['user_id'] ?? 0);
        if ($userId <= 0) {
            flash('error', 'You must login first.');
            redirect('/login');
        }

        $name = trim($_POST['name'] ?? '');
        $bio = trim($_POST['bio'] ?? null);
        $location = trim($_POST['location'] ?? null);
        $avatarPath = null;

        // Basic validation
        if ($name === '') {
            flash('error', 'Name is required.');
            redirect('/profile/edit');
        }

        // Avatar upload handling (optional)
        if (!empty($_FILES['avatar']['tmp_name'])) {
            $allowed = ['image/jpeg','image/png','image/webp'];
            $type = $_FILES['avatar']['type'] ?? '';
            $size = $_FILES['avatar']['size'] ?? 0;
            if (!in_array($type, $allowed) || $size > 2_000_000) {
                flash('error', 'Invalid avatar. Use PNG/JPG/WebP under 2MB.');
                redirect('/profile/edit');
            }
            $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $filename = 'avatar_' . $userId . '_' . time() . '.' . $ext;
            $publicDir = __DIR__ . '/../../public/uploads/avatars/';
            if (!is_dir($publicDir)) mkdir($publicDir, 0755, true);
            $target = $publicDir . $filename;
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
                flash('error', 'Failed to save avatar.');
                redirect('/profile/edit');
            }
            $avatarPath = '/uploads/avatars/' . $filename;
        }

        // Update via model (make sure updateProfile exists)
        $this->userModel->updateProfile($userId, $name, $bio, $location, $avatarPath);

        flash('success', 'Profile updated.');
        redirect('/profile');
    }
}
