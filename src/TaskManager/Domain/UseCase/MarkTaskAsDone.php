<?php 

namespace App\TaskManager\Domain\UseCase;

use App\TaskManager\Domain\Entity\Task;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;

class MarkTaskAsDone {


    public function __construct(private TaskRepositoryInterface $taskRepository)
    {}
    
    public function execute(string $taskUuid): void
    {

        $task = $this->taskRepository->findById($taskUuid);

        $task->markAsDone();

        $this->taskRepository->save($task);
    }

}

?>