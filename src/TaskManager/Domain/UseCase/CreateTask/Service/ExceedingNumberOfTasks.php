<?php

namespace App\TaskManager\Domain\UseCase\CreateTask\Service;

use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;

class ExceedingNumberOfTasks {

    public function __construct(
        private TaskRepositoryInterface $taskReposity
    )
    {}

    public function check(User $user)
    {
        $tasks = $this->taskReposity->findBy(['user_id' => $user->getUuid()]);

        return count($tasks) > 5;

    }


}

?>
