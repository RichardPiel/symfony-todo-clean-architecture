<?php

namespace App\TaskManager\Domain\UseCase\ListTasks;

class ListTasksResponse
{

    private array $tasks;

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function setTasks(array $tasks): void
    {
        $this->tasks = $tasks;
    }
}

?>