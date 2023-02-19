<?php

namespace App\Tests\TaskManager\Infrastructure\Mailer;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Infrastructure\Mailer\SymfonyMailer;

class SymfonyMailerTest extends KernelTestCase
{
    public function testSend()
    {
        $mock = $this->createMock(MailerInterface::class);

        $mock->expects($this->once())
            ->method('send')
            ->with($this->callback(function ($email) {

                $this->assertInstanceOf(Email::class, $email);

                return true;

            }));

        $mailer = new SymfonyMailer($mock);

        $mailer->send('test@example.com', 'Test Subject', 'Test Body');

    }
}
?>