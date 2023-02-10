<?php

namespace App\TaskManager\Domain\UseCase\CreateTask;

use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\UseCase\ResponseTrait;

class CreateTaskResponse
{

    use ResponseTrait;

    public ?string $taskUuid = null;

    public function getTaskUuid(): ?string    
    {
        return $this->taskUuid;
    }

    public function setTaskUuid(string $taskUuid): void
    {
        $this->taskUuid = $taskUuid;
    }

}

?>