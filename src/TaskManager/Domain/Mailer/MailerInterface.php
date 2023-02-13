<?php

namespace App\TaskManager\Domain\Mailer;

interface MailerInterface
{
    public function send(string $to, string $subject, string $body): void;
}
?>