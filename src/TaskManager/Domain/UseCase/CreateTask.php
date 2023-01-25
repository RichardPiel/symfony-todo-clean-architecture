<?php

namespace App\TaskManager\Domain\UseCase;

use App\TaskManager\Domain\Entity\Task;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;

class CreateTask
{

    public function __construct(public TaskRepositoryInterface $taskRepository)
    {}

    public function execute(Task $task)
    {
        $this->taskRepository->save($task);
    }
}

?>