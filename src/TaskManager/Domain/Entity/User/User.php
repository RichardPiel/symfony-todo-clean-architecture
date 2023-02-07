<?php

namespace App\TaskManager\Domain\Entity\User;

use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use Doctrine\Common\Collections\ArrayCollection;

class User implements \JsonSerializable
{
    /**
     * @var array<Task>
     */
    protected $tasks;
    protected ?string $uuid;
    protected ?string $email;
    protected string $password;
    protected $tags;
    
    public function __construct(UserId $uuid = null, UserEmail $email = null)
    {
        $this->uuid = $uuid?->getValue();
        $this->email = $email;
        $this->tasks = new ArrayCollection();
        $this->tags = new ArrayCollection();
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
            // 'tasks' => $this->tasks
        ];
    }

    public function setTasks(mixed $tasks): void
    {
        $this->tasks = $tasks;
    }

    public function getTags()
        {
        return $this->tags;
    }

    public function setTags($tags): void
    {
        $this->tags = $tags;
    }
}