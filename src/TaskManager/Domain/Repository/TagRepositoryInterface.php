<?php 

namespace App\TaskManager\Domain\Repository;

use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\Entity\User\User;

interface TagRepositoryInterface
{

    /**
     * @param Tag $tag
     * @return void
     */
    public function save(Tag $tag): void;

    /**
     * @param string $id
     * @return Tag|null
     */
    public function findByIdAndUser(string $id, User $user): ?Tag;

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param integer|null $limit
     * @param integer|null $offset
     * @return array
     */
    public function findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null): array;

    public function update(Tag $tag): void;

 
}

?>