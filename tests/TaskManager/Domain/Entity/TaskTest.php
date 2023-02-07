<?php

namespace App\Tests\TaskManager\Domain\Entity;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\Task\TaskId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Domain\Exception\TaskAlreadyDoneException;

class TaskTest extends KernelTestCase
{
    public function testConstruct(): void
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $this->assertNotNull($task);
        $this->assertEquals('name', $task->getName());
    }

    public function testSetName(): void
    {
        $task = new Task(
           TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $task->setName('new name');

        $this->assertEquals('new name', $task->getName());
    }

    public function testSetContent(): void
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $task->setContent('new content');

        $this->assertEquals('new content', $task->getContent());
    }

    public function testSetUuid(): void
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $task->setUuid(
            TaskId::fromString(Uuid::uuid4()),
        );

        $this->assertNotNull($task->getUuid());
    }

    public function testGetCreatedAt(): void
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $this->assertNotNull($task->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getCreatedAt());
    }

    public function testCannotMarkAsDoneIfAlreadyDone(): void
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'test'
        );

        $task->markAsDone();

        $this->expectException(TaskAlreadyDoneException::class);

        $task->markAsDone();
    }

    public function testJsonSerialize()
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'test'
        );

        $task->setContent('content');

        $this->assertJson(json_encode($task));
    }

    public function testSetGetUser()
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'test'
        );

        $user = $this->getMockBuilder(User::class)->getMock();
        $task->setUser($user);

        $this->assertEquals($user, $task->getUser());
    }
}
