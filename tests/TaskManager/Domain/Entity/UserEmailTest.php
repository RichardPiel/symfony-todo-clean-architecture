<?php

namespace App\Tests\TaskManager\Domain\Entity\User;

use App\TaskManager\Domain\Entity\User\UserEmail;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserEmailTest extends KernelTestCase
{
    /**
     * @dataProvider providerValidsEmails
     * @return void
     */
    public function testUserEmailIsValid(string $email)
    {
        $userEmail = UserEmail::fromString($email);
        $this->assertEquals($email, $userEmail);
    }

    /**
     * @dataProvider providerInvalidsEmails
     * @return void
     */
    public function testUserEmailIsInvalid(string $email)
    {

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid email format!');

        UserEmail::fromString($email);
    }

    /**
     * @return array<string[]>
     */
    public function providerValidsEmails(): array
    {
        return [
            ['toto@gmail.com'],
            ['toto+bidule@gmail.com'],
            ['toto.bidule@gmail.com'],
            ['toto.bidule@123.com'],
        ];
    }

    /**
     * @return array<string[]>
     */
    public function providerInvalidsEmails(): array
    {
        return [
            ['totogmail.com'],
            ['toto+bidule@gmail'],
            ['toto+bidule@@213.com'],
        ];
    }
}
