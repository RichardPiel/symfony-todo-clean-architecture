<?php

namespace App\TaskManager\Infrastructure\Repository\Doctrine;

use App\TaskManager\Domain\Entity\Task\Task;
use Doctrine\Persistence\ManagerRegistry;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;

class TaskRepository extends ServiceEntityRepository implements TaskRepositoryInterface
{
    private EntityManager $entityManager;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @return array<Task>
     */
    public function findAll(): array
    {
        return [];
    }

    /**
     * @param string $id
     * @return Task|null
     */
    public function findById(string $id): ?Task
    {
        return $this->getEntityManager()->find(Task::class, $id);
    }

    /**
     * @param Task $task
     * @return void
     */
    public function save(Task $task): void
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Task $task
     * @return void
     */
    public function remove(Task $task): void
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }
}
