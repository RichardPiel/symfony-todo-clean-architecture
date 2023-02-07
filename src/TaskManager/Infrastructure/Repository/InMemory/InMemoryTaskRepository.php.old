<?php

namespace App\TaskManager\Infrastructure\Repository\InMemory;

use App\TaskManager\Domain\Entity\Task\Task;
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

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        $tasks = [];
        foreach ($this->tasks as $task) {
            $match = true;
            foreach ($criteria as $field => $value) {
                if ($value === 'NOT NULL') {
                    if ($task->$field === null) {
                        $match = false;
                        break;
                    }
                } elseif ($task->$field != $value) {
                    $match = false;
                    break;
                }
            }
            if ($match) {
                $tasks[] = $task;
            }
        }
    
        return $tasks;
    }
}