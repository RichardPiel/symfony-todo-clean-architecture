<?php

namespace App\Tests\TaskManager\Domain\UseCase;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\DTO\CreateTaskDTO;
use App\TaskManager\Domain\UseCase\CreateTask;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Tests\TaskManager\Infrastructure\Repository\InMemoryTaskRepository;

class CreateTaskTest extends KernelTestCase
{
    /**
     * @return void
     */
    public function testCreateTask(): void
    {
        $inMemoryTaskRepository = new InMemoryTaskRepository();

        $taskDTO = new CreateTaskDTO(
            'test',
            'test',
            Uuid::uuid4()->toString()
        );

        $taskCreated = (new CreateTask($inMemoryTaskRepository))->execute($taskDTO);

        $this->assertNotNull($inMemoryTaskRepository->findAll());

        $this->assertNotNull($inMemoryTaskRepository->findById($taskCreated->getUuid()));
    }
}
