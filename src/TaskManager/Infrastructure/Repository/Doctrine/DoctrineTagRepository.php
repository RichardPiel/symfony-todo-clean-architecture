<?php

namespace App\TaskManager\Infrastructure\Repository\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Repository\TagRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineTagRepository extends ServiceEntityRepository implements TagRepositoryInterface
{
    private EntityManager $entityManager;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    /**
     * @param string $id
     * @return Tag|null
     */
    public function findByIdAndUser(string $id, User $user): ?Tag
    {
        return $this->findOneBy(['uuid' => $id, 'user' => $user]);
    }

    /**
     * @param Tag $task
     * @return void
     */
    public function save(Tag $task): void
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }

    public function update(Tag $task): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param Tag $task
     * @return void
     */
    public function remove(Tag $task): void
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return array<Tag>
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }
}