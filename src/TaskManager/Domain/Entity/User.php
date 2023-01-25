<?php

namespace App\TaskManager\Domain\Entity;

use App\TaskManager\Domain\Entity\UserId;
use JsonSerializable;

class User implements JsonSerializable
{

    protected array $tasks = [];
    protected string $uuid;
    protected string $email;

    protected string $password;

    public function __construct(UserId $uuid, UserEmail $email)
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

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Surement pas une bonne pratique, on devrait utiliser class
     * dédiée.
     *
     * @return array
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

?>