<?php

namespace App\Tests\TaskManager\Domain\UseCase;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\DTO\CreateTaskDTO;
use App\TaskManager\Domain\DTO\CreateUserDTO;
use App\TaskManager\Domain\UseCase\CreateTask;
use App\TaskManager\Domain\UseCase\CreateUser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Tests\TaskManager\Infrastructure\Repository\InMemoryTaskRepository;
use App\Tests\TaskManager\Infrastructure\Repository\InMemoryUserRepository;

class CreateTaskTest extends KernelTestCase
{
    /**
     * @return void
     */
    public function testCreateTask(): void
    {
        $inMemoryTaskRepository = new InMemoryTaskRepository();
        $inMemoryUserRepository = new InMemoryUserRepository();

        $userDTO = new CreateUserDTO(
            'r.piel@webandcow.com',
            'password'
        );

        $userCreated = (new CreateUser($inMemoryUserRepository))->execute($userDTO);

        $taskDTO = new CreateTaskDTO(
            'test',
            'test',
            $userCreated->getUuid()
        );

        $taskCreated = (new CreateTask($inMemoryTaskRepository, $inMemoryUserRepository))->execute($taskDTO);

        $this->assertNotNull($inMemoryTaskRepository->findAll());

        $this->assertNotNull($inMemoryTaskRepository->findById($taskCreated->getUuid()));
    }
}
