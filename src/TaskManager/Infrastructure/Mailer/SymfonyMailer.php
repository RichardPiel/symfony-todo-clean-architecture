<?php

namespace App\TaskManager\Infrastructure\Mailer;

use Symfony\Component\Mime\Email;
use App\TaskManager\Domain\Mailer\MailerInterface;
use Symfony\Component\Mailer\MailerInterface as SymfonyMailerInterface;

class SymfonyMailer implements MailerInterface
{
    private $mailer;

    public function __construct(SymfonyMailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(string $to, string $subject, string $body): void
    {
          $email = (new Email())
            ->from('hello@example.com')
            ->to($to)
            ->subject($subject)
            ->text($body);

        $this->mailer->send($email);

    }
}