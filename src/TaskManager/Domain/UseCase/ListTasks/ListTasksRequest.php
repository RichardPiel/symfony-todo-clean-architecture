<?php

namespace App\TaskManager\Domain\UseCase\ListTasks;

use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\RequestInterface;

class ListTasksRequest implements RequestInterface
{

    public function __construct(protected User $user)
    {}

    public function getUser(): User
    {
        return $this->user;
    }
}

?>