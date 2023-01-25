<?php

namespace App\TaskManager\Infrastructure\Repository;

use App\TaskManager\Domain\Entity\User;
use App\TaskManager\Domain\Entity\UserId;
use Doctrine\Persistence\ManagerRegistry;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineUserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    private $entityManager;
    private $repository;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(string $id): ?User
    {
        return $this->repository->find($id);
    }
    public function save(User $task): void
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }

    public function remove(User $task): void
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }

    public function findByEmail(string $email): ?User
    {
        return $this->repository->findOneBy(['email' => $email]);
    }
}
?>