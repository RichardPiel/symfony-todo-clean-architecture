<?php

namespace App\Tests\TaskManager\Domain\UseCase;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task;
use App\TaskManager\Domain\Entity\TaskId;
use App\TaskManager\Domain\UseCase\CreateTask;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Tests\TaskManager\Infrastructure\Repository\InMemoryTaskRepository;

class MarkTaskAsDoneTest extends KernelTestCase
{

    private $inMemoryTaskRepository;

    public function setUp(): void
    {
        $this->inMemoryTaskRepository = new InMemoryTaskRepository();
    }

    public function testMarkTaskAsDone()
    {

        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'test',
            'test'
        );

        (new CreateTask($this->inMemoryTaskRepository))->execute($task);
        $this->assertNull($task->getDoneAt());

        (new MarkTaskAsDone($this->inMemoryTaskRepository))->execute($task->getUuid());
        $this->assertNotNull($task->getDoneAt());

    }
 
}

?>