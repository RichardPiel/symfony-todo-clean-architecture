<?php

namespace App\TaskManager\Domain\UseCase\ListTasks;

use App\TaskManager\Domain\Entity\User\User;

class ListTasksRequest
{

    public function __construct(protected User $user)
    {}

    public function getUser(): User
    {
        return $this->user;
    }
}

?>