<?php

namespace App\TaskManager\Infrastructure\Repository\Doctrine;

use App\TaskManager\Domain\Entity\Task\Task;
use Doctrine\Persistence\ManagerRegistry;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;

class DoctrineTaskRepository extends ServiceEntityRepository implements TaskRepositoryInterface
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
     * @param string $id
     * @return Task|null
     */
    public function findById(string $id): ?Task
    {
        return $this->findOneBy(['uuid' => $id]);
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

    public function update(Task $task): void
    {
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

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return array<Task>
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }
}