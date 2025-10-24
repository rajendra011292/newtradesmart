<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\PasswordReset;
use App\Core\Middleware\Csrf;

class PasswordController {
    private User $userModel;
    private PasswordReset $prModel;
    private $mailer; // optional mailer service injected

    public function __construct(\App\Core\Database $db, $mailer = null) {
        $this->userModel = new User($db);
        $this->prModel   = new PasswordReset($db);
        $this->mailer = $mailer;
    }

    public function showRequestForm() {
        include __DIR__ . '/../Views/auth/password_forgot.php';
    }

    public function sendReset() {
        if (!Csrf::validateToken($_POST['csrf_token'] ?? null)) { flash('error','Invalid CSRF'); redirect('/password/forgot'); }
        $email = strtolower(trim($_POST['email'] ?? ''));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { flash('error','Enter valid email'); redirect('/password/forgot'); }

        $user = $this->userModel->findByEmail($email);
        if (!$user) { // don't reveal existence
            flash('success','If that email exists we sent reset instructions.'); redirect('/password/forgot');
        }

        // generate token
        $token = bin2hex(random_bytes(32)); // 64 chars
        $this->prModel->create($email, $token);

        // build reset link
        $link = ($_ENV['BASE_URL'] ?? '') . '/password/reset/' . $token;

        // send email (use mailer service or PHPMailer)
        if ($this->mailer) {
            $this->mailer->send($email, 'Password reset', "Click to reset: $link");
        } else {
            // fallback: mail() - not recommended; ideally use PHPMailer (see snippet below)
            @mail($email, "Reset your password", "Reset link: $link");
        }

        flash('success','If that email exists we sent reset instructions.');
        redirect('/password/forgot');
    }

    public function showResetForm($token) {
        // optionally check token exists & not expired before showing form
        $row = $this->prModel->findByToken($token);
        if (!$row || $this->tokenExpired($row['created_at'])) {
            flash('error','Invalid or expired token.');
            redirect('/password/forgot');
        }
        include __DIR__ . '/../Views/auth/password_reset.php';
    }

    public function reset() {
        if (!Csrf::validateToken($_POST['csrf_token'] ?? null)) { flash('error','Invalid CSRF'); redirect('/password/forgot'); }
        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['password_confirm'] ?? '';

        if ($password === '' || $password !== $confirm || strlen($password) < 6) {
            flash('error','Password error.'); redirect('/password/reset/' . $token);
        }

        $row = $this->prModel->findByToken($token);
        if (!$row || $this->tokenExpired($row['created_at'])) {
            flash('error','Invalid or expired token.'); redirect('/password/forgot');
        }

        // update password
        $user = $this->userModel->findByEmail($row['email']);
        if (!$user) { flash('error','User not found'); redirect('/password/forgot'); }

        $this->userModel->updatePassword((int)$user['id'], password_hash($password, PASSWORD_DEFAULT));
        $this->prModel->deleteByEmail($row['email']);

        flash('success','Password updated. You can login now.');
        redirect('/login');
    }

    private function tokenExpired(string $created_at): bool {
        $created = new \DateTime($created_at);
        $now = new \DateTime();
        $diff = $now->getTimestamp() - $created->getTimestamp();
        return $diff > 3600; // 1 hour expiry
    }
}
