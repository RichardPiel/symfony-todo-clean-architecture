<?php

namespace App\Tests\TaskManager\Domain\UseCase\Register;

use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\UseCase\Register\RegisterUserResponse;
use PHPUnit\Framework\TestCase;

class RegisterUserResponseTest extends TestCase
{
    /**
     * @var RegisterUserResponse
     */
    private $registerUserResponse;

    public function setUp(): void
    {
        $this->registerUserResponse = new RegisterUserResponse();
    }

    public function testGetUser(): void
    {
        $user = new User();
        $this->registerUserResponse->setUser($user);

        $this->assertSame($user, $this->registerUserResponse->getUser());
    }

    public function testGetError(): void
    {
        $error = ['email' => 'Email address already exists'];
        $this->registerUserResponse->setError('email', $error['email']);

        $this->assertSame($error, $this->registerUserResponse->getErrors());
    }

    public function testHasError(): void
    {
        $error = ['email' => 'Email address already exists'];
        $this->registerUserResponse->setError('email', $error['email']);

        $this->assertTrue($this->registerUserResponse->hasError());
    }

    public function testHasNoError(): void
    {
        $this->assertFalse($this->registerUserResponse->hasError());
    }
}