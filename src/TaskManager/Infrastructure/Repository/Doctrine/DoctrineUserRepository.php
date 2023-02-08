<?php

namespace App\TaskManager\Infrastructure\Repository\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineUserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    private EntityManager $entityManager;
    private $repository;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return array<User>
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param string $id
     * @return User|null
     */
    public function findById(string $id): ?User
    {
        return $this->getEntityManager()->find(User::class, $id);
    }

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @param User $user
     * @return void
     */
    public function remove(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findOneBy(array $criteria, ?array $orderBy = null): ?User
    {
        return parent::findOneBy($criteria);
    }
}
