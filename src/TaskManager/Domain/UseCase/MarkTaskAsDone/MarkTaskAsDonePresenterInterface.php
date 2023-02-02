<?php

namespace App\TaskManager\Domain\UseCase\MarkTaskAsDone;

use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskResponse;

interface MarkTaskAsDonePresenterInterface {

    public function present(MarkTaskAsDoneResponse $response): void;

}

?>