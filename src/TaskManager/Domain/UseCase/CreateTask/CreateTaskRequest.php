<?php

namespace App\TaskManager\Domain\UseCase\CreateTask;

use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\RequestInterface;

class CreateTaskRequest implements RequestInterface
{
    public function __construct(
        private string $name,
        private User $user,
        private ?string $content = null,
        private ?string $parentTaskId = null,
        private ?string $tags = null
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getParentTaskId(): ?string
    {
        return $this->parentTaskId;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }
}

?>