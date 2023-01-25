<?php

namespace App\TaskManager\Infrastructure\Repository;

use App\TaskManager\Domain\Entity\Task;
use App\TaskManager\Domain\Entity\TaskId;
use Doctrine\Persistence\ManagerRegistry;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineTaskRepository extends ServiceEntityRepository implements TaskRepositoryInterface
{
    private $entityManager;
    private $repository;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findAll(): array
    {
        return [];
    }

    public function findById(string $id): ?Task
    {
        return $this->getEntityManager()->find(Task::class, $id);
    }
    public function save(Task $task): void
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }

    public function remove(Task $task): void
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }
}
?>