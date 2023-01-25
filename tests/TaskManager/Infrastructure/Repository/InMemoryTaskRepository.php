<?php 

namespace App\Tests\TaskManager\Infrastructure\Repository;
use App\TaskManager\Domain\Entity\Task;
use App\TaskManager\Domain\Entity\TaskId;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;

class InMemoryTaskRepository implements TaskRepositoryInterface
{
    private $tasks = [];

    public function save(Task $task): void
    {
        $this->tasks[$task->getUuid()] = $task;
    }

    public function findById(string $id): ?Task
    {
        return $this->tasks[$id] ?? null;
    }

    public function findAll(): array
    {
        return $this->tasks;
    }
    
}

?>