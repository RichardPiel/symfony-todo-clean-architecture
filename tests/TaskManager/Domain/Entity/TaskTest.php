<?php

namespace App\Tests\TaskManager\Domain\Entity;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\Task\TaskId;
use App\TaskManager\Domain\Exception\TaskAlreadyDoneException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskTest extends KernelTestCase
{
    public function testConstruct(): void
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'name'
        );

        $this->assertNotNull($task);
        $this->assertEquals('name', $task->getName());
    }

    public function testSetName(): void
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'name'
        );

        $task->setName('new name');

        $this->assertEquals('new name', $task->getName());
    }

    public function testSetContent(): void
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'name'
        );

        $task->setContent('new content');

        $this->assertEquals('new content', $task->getContent());
    }

    public function testSetUuid(): void
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'name'
        );

        $task->setUuid(
            new TaskId(Uuid::uuid4()->toString())
        );

        $this->assertNotNull($task->getUuid());
    }

    public function testGetCreatedAt(): void
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'name'
        );

        $this->assertNotNull($task->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getCreatedAt());
    }

    public function testCannotMarkAsDoneIfAlreadyDone(): void
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'test'
        );

        $task->markAsDone();

        $this->expectException(TaskAlreadyDoneException::class);

        $task->markAsDone();
    }
}
