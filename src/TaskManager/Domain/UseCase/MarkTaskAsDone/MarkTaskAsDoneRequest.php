<?php

namespace App\TaskManager\Domain\UseCase\MarkTaskAsDone;

use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\RequestInterface;

class MarkTaskAsDoneRequest implements RequestInterface
{

    public function __construct(
        protected string $uuidTask,
        protected User $user
    )
    {
    }

    public function getUuidTask(): string
    {
        return $this->uuidTask;
    }

    public function getUser(): User
    {
        return $this->user;
    }

}

?>