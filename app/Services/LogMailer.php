<?php
namespace App\Services;

/**
 * Dev Mailer: logs email deliveries to storage/logs/mails.log
 * Safe for local development — no SMTP required.
 */
class LogMailer
{
    private string $logPath;

    public function __construct(?string $logPath = null)
    {
        $base = __DIR__ . '/../../storage/logs';
        if (!is_dir($base)) {
            mkdir($base, 0755, true);
        }
        $this->logPath = $logPath ?? $base . '/mails.log';
    }

    /**
     * Log an email (to, subject, body).
     * Returns true on success.
     */
    public function send(string $to, string $subject, string $body): bool
    {
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        $entry = "------------------------\n";
        $entry .= "Time: {$now}\n";
        $entry .= "To: {$to}\n";
        $entry .= "Subject: {$subject}\n";
        $entry .= "Body:\n{$body}\n";
        $entry .= "------------------------\n\n";

        // Append atomically
        return (bool) file_put_contents($this->logPath, $entry, FILE_APPEND | LOCK_EX);
    }

    /** Optional: return the path to the log file */
    public function getLogPath(): string
    {
        return $this->logPath;
    }
}
