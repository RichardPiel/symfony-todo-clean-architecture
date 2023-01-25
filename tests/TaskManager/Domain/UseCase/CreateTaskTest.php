<?php

namespace App\Tests\TaskManager\Domain\UseCase;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task;
use App\TaskManager\Domain\Entity\TaskId;
use App\TaskManager\Domain\UseCase\CreateTask;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Tests\TaskManager\Infrastructure\Repository\InMemoryTaskRepository;

class CreateTaskTest extends KernelTestCase
{

    public function testCreateTask()
    {
        $inMemoryTaskRepository = new InMemoryTaskRepository();

        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            'test',
            'test'
        );

        (new CreateTask($inMemoryTaskRepository))->execute($task);

        $this->assertNotNull($inMemoryTaskRepository->findAll());

        $this->assertNotNull($inMemoryTaskRepository->findById($task->getUuid()));


    }

}

?>