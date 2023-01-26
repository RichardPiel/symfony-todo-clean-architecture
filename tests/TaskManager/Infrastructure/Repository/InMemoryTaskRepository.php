<?php

namespace App\Tests\TaskManager\Infrastructure\Repository;

use App\TaskManager\Domain\Entity\Task;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;

class InMemoryTaskRepository implements TaskRepositoryInterface
{
    /**
     * @var array<Task>
     */
    private array $tasks = [];

    /**
     * @param Task $task
     * @return void
     */
    public function save(Task $task): void
    {
        $this->tasks[$task->getUuid()] = $task;
    }

    /**
     * @param string $id
     * @return Task|null
     */
    public function findById(string $id): ?Task
    {
        return $this->tasks[$id] ?? null;
    }

    /**
     * @return array<Task>
     */
    public function findAll(): array
    {
        return $this->tasks;
    }
}
