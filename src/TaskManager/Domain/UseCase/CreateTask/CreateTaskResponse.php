<?php

namespace App\TaskManager\Domain\UseCase\CreateTask;

use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\UseCase\ResponseTrait;

class CreateTaskResponse
{

    use ResponseTrait;

    public ?Task $task = null;

    public function getTask(): ?Task    
    {
        return $this->task;
    }

    public function setTask(Task $task): void
    {
        $this->task = $task;
    }

}

?>