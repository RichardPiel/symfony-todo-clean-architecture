<?php

namespace App\TaskManager\Domain\Entity\Tag;

use App\TaskManager\Domain\Entity\User\User;

class Tag implements \JsonSerializable
{

    protected string $uuid;
    protected string $name;
    protected array $tasks;
    protected User $user;
    public function __construct(TagId $uuid, string $name)
    {
        $this->uuid = $uuid->getValue();
        $this->name = $name;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }
    
    public function setTasks(array $tasks): void
    {
        $this->tasks = $tasks;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
  
    public function jsonSerialize(): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
        ];
    }
}

?>