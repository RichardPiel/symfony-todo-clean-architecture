<?php

namespace App\TaskManager\Domain\Repository;

use App\TaskManager\Domain\Entity\Task\Task;

/**
 * @method Task|null findById($id)
 */
interface TaskRepositoryInterface
{
    /**
     * @param Task $task
     * @return void
     */
    public function save(Task $task): void;

    /**
     * @param string $id
     * @return Task|null
     */
    public function findById(string $id): ?Task;

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param integer|null $limit
     * @param integer|null $offset
     * @return array
     */
    public function findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null): array;

    public function update(Task $task): void;

}
