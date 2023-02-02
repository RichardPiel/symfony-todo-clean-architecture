<?php

namespace App\TaskManager\Domain\UseCase\CreateTask;

use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskResponse;

interface CreateTaskPresenterInterface
{

    public function present(CreateTaskResponse $response): void;

}

?>