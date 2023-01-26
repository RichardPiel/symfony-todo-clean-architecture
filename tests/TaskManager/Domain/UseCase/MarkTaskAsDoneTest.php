<?php

namespace App\Tests\TaskManager\Domain\UseCase;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\DTO\CreateTaskDTO;
use App\TaskManager\Domain\UseCase\CreateTask;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Tests\TaskManager\Infrastructure\Repository\InMemoryTaskRepository;

class MarkTaskAsDoneTest extends KernelTestCase
{
    private InMemoryTaskRepository $inMemoryTaskRepository;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->inMemoryTaskRepository = new InMemoryTaskRepository();
    }

    /**
     * @return void
     */
    public function testMarkTaskAsDone(): void
    {
        $taskDTO = new CreateTaskDTO(
            'test',
            'test',
            Uuid::uuid4()->toString()
        );

        $taskCreated = (new CreateTask($this->inMemoryTaskRepository))->execute($taskDTO);
        $this->assertNull($taskCreated->getDoneAt());

        (new MarkTaskAsDone($this->inMemoryTaskRepository))->execute($taskCreated->getUuid());
        $this->assertNotNull($taskCreated->getDoneAt());
    }
}
