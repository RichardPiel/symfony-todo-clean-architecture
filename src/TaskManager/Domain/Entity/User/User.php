<?php

namespace App\TaskManager\Domain\Entity\User;

use JsonSerializable;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\UserId;

class User implements JsonSerializable
{
    /**
     * @var array<Task>
     */
    protected array $tasks = [];
    protected string $uuid;
    protected string $email;

    protected string $password;

    public function __construct(UserId $uuid = null, UserEmail $email = null)
    {
        $this->uuid = $uuid->getValue();
        $this->email = $email;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return array<Task>
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Surement pas une bonne pratique, on devrait utiliser class
     * dédiée.
     *
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'uuid' => $this->uuid,
            'email' => $this->email,
            'tasks' => $this->tasks
        ];
    }
}
