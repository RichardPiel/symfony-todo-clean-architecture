<?php

namespace App\TaskManager\Domain\UseCase\CreateTask;

use App\TaskManager\Domain\Entity\User\User;

class CreateTaskRequest
{
    public function __construct(
        private string $name,
        private string $content,
        private User $user
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}

?>