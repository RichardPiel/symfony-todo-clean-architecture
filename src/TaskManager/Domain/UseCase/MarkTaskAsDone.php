<?php

namespace App\TaskManager\Domain\UseCase;

use App\TaskManager\Domain\Repository\TaskRepositoryInterface;

class MarkTaskAsDone
{
    /**
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    /**
     * @param string $taskUuid
     * @return void
     */
    public function execute(string $taskUuid): void
    {
        $task = $this->taskRepository->findById($taskUuid);

        if (is_null($task)) {
            throw new \Exception("Task not found");
        }

        $task->markAsDone();

        $this->taskRepository->save($task);
    }
}
