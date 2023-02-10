<?php

namespace App\TaskManager\Application\ViewModel;

use App\TaskManager\Domain\Entity\Task\Task;

class MarkTaskAsDoneJsonViewModel
{
    public ?array $errors;
    public ?Task $task;

}

?>