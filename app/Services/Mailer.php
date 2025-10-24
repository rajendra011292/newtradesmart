<?php
namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer {
    private PHPMailer $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV['MAIL_HOST'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $_ENV['MAIL_USERNAME'];
        $this->mail->Password = $_ENV['MAIL_PASSWORD'];
        $this->mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'] ?? 'tls';
        $this->mail->Port = $_ENV['MAIL_PORT'] ?? 587;
        $this->mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME'] ?? 'TradeSmart');
    }

    public function send(string $to, string $subject, string $body): bool {
        try {
            $this->mail->clearAllRecipients();
            $this->mail->addAddress($to);
            $this->mail->isHTML(false);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->send();
            return true;
        } catch (\Throwable $e) {
            error_log('Mailer error: '.$e->getMessage());
            return false;
        }
    }
}
