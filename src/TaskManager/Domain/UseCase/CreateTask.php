<?php

namespace App\TaskManager\Domain\UseCase;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\DTO\CreateTaskDTO;
use App\TaskManager\Domain\Entity\Task\TaskId;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;

class CreateTask
{
    public function __construct(public TaskRepositoryInterface $taskRepository, public UserRepositoryInterface $userRepository)
    {
    }

    public function execute(CreateTaskDTO $taskDTO): Task
    {
        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            $taskDTO->getTitle(),
        );
        $task->setUser($this->userRepository->findById($taskDTO->getUserId()));

        $task->setContent($taskDTO->getContent());

        $this->taskRepository->save($task);

        return $task;
    }
}