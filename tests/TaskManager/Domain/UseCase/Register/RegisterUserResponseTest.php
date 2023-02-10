<?php

namespace App\Tests\TaskManager\Domain\UseCase\Register;

use App\TaskManager\Domain\Entity\User\UserId;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\UseCase\Register\RegisterUserResponse;

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

    public function testGetUserUuid(): void
    {
        $userUuid = UserId::fromString(Uuid::uuid4())->getValue();
        $this->registerUserResponse->setUserUuid($userUuid);

        $this->assertSame($userUuid, $this->registerUserResponse->getUserUuid());
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