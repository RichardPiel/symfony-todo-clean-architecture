<?php 

namespace App\TaskManager\Domain\Repository;

use App\TaskManager\Domain\Entity\Task;
use App\TaskManager\Domain\Entity\TaskId;


/**
 * @method Task|null findById($id)
 */
interface TaskRepositoryInterface {

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

    public function findAll(): array;


}


?>