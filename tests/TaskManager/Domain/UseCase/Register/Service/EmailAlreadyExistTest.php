<?php

namespace App\Tests\TaskManager\Domain\UseCase\Register\Service;

use PHPUnit\Framework\TestCase;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\User\UserEmail;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;
use App\TaskManager\Domain\UseCase\Register\Service\CheckIfEmailAlreadyUsed;

class CheckIfEmailAlreadyUsedTest extends TestCase
{
    /**
     * @var UserRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $userRepository;

    /**
     * @var CheckIfEmailAlreadyUsed
     */
    private $emailAlreadyExist;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->emailAlreadyExist = new CheckIfEmailAlreadyUsed($this->userRepository);
    }

    public function testCheckShouldReturnTrueWhenEmailAlreadyExist()
    {
        $email = 'test@email.com';
        $user = new User(null, UserEmail::fromString($email));

        $this->userRepository
            ->expects($this->once())
            ->method('findByEmail')
            ->with($email)
            ->willReturn($user)
        ;

        $this->assertTrue($this->emailAlreadyExist->check($email));
    }

    public function testCheckShouldReturnFalseWhenEmailDoesNotExist()
    {
        $email = 'test@email.com';

        $this->userRepository
            ->expects($this->once())
            ->method('findByEmail')
            ->with($email)
            ->willReturn(null)
        ;
        $this->assertFalse($this->emailAlreadyExist->check($email));
    }
}