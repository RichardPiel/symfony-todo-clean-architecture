<?php

namespace App\TaskManager\Domain\UseCase\MarkTaskAsDone;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\UseCase\ResponseTrait;


class MarkTaskAsDoneResponse {

    use ResponseTrait;

    protected ?Task $task = null;

    public function setTask(Task $task): void
    {
        $this->task = $task;
    }

    public function getTask(): Task 
    {
        return $this->task;
    }

}

?>