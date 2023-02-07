<?php

namespace App\TaskManager\Tests\Domain\UseCase\CreateTask\Service;

use App\TaskManager\Domain\Entity\User\UserEmail;
use App\TaskManager\Domain\Entity\User\UserId;
use PHPUnit\Framework\TestCase;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\UseCase\CreateTask\Service;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;
use App\TaskManager\Domain\UseCase\CreateTask\Service\ExceedingNumberOfTasks;
use Ramsey\Uuid\Uuid;

class ExceedingNumberOfTasksTest extends TestCase
{

    public function testCheck()
    {
        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('test@example.com')
        );

        $taskReposityMock = $this->createMock(TaskRepositoryInterface::class);

        $taskReposityMock->expects($this->once())
            ->method('findBy')
            ->with(['user' => $user])
            ->willReturn([1, 2, 3, 4, 5, 6]);

        $exceedingNumberOfTasks = new ExceedingNumberOfTasks($taskReposityMock);

        $this->assertTrue($exceedingNumberOfTasks->check($user));

    }

    public function testCheckFalse()
    {
        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('test@example.com')
        );

        $taskReposityMock = $this->createMock(TaskRepositoryInterface::class);

        $taskReposityMock->expects($this->once())
            ->method('findBy')
            ->with(['user' => $user])
            ->willReturn([1, 2, 3, 4]);

        $exceedingNumberOfTasks = new ExceedingNumberOfTasks($taskReposityMock);

        $this->assertFalse($exceedingNumberOfTasks->check($user));

    }
}