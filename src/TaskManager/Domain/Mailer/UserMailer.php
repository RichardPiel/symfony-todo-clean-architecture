<?php

namespace App\TaskManager\Domain\Mailer;

use App\TaskManager\Domain\Mailer\MailerInterface;

class UserMailer
{
    public function __construct(
        private MailerInterface $mailer
    )
    {
    }

    public function sendWelcome($user): void
    {
        $this->mailer->send($user->getEmail(), 'Welcome', 'Welcome to our app');
    }

}

?>