<?php

namespace App\TaskManager\Application\Presenter;

use App\TaskManager\Domain\Entity\Task\Task;

class MarkTaskAsDoneJsonViewModel
{
    public function __construct(
        public ?array $errors = null,
        public ?Task $task = null,
    )
    {
    }

}

?>