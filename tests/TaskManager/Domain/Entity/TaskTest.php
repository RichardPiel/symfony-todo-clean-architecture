<?php

namespace App\Tests\TaskManager\Domain\Entity;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task;
use App\TaskManager\Domain\Entity\TaskId;
use App\TaskManager\Domain\Exception\TaskAlreadyDoneException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskTest extends KernelTestCase
{


    public function testConstruct()
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'name',
            'content'
        );

        $this->assertNotNull($task);
        $this->assertEquals('name', $task->getName());
        $this->assertEquals('content', $task->getContent());
    }

    public function testSetName()
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'name',
            'content'
        );

        $task->setName('new name');

        $this->assertEquals('new name', $task->getName());
    }

    public function testSetContent()
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'name',
            'content'
        );

        $task->setContent('new content');

        $this->assertEquals('new content', $task->getContent());
    }

    public function testSetUuid()
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'name',
            'content'
        );

        $task->setUuid(new TaskId(Uuid::uuid4()->toString()));

        $this->assertNotNull($task->getUuid());
    }

    public function testGetCreatedAt()
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'name',
            'content'
        );

        $this->assertNotNull($task->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getCreatedAt());
    }

    public function testCannotMarkAsDoneIfAlreadyDone()
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'test',
            'test'
        );

        $task->markAsDone();

        $this->expectException(TaskAlreadyDoneException::class);

        $task->markAsDone();
    }

}

?>