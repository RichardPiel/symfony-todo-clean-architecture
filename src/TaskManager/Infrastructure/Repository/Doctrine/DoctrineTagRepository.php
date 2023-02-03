<?php

namespace App\TagManager\Infrastructure\Repository\Doctrine;

use App\TaskManager\Domain\Entity\Tag\Tag;
use Doctrine\Persistence\ManagerRegistry;
use App\TagManager\Domain\Repository\TagRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;

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
    public function findById(string $id): ?Tag
    {
        return $this->findOneBy(['uuid' => $id]);
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