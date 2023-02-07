<?php 

namespace App\TaskManager\Application\ViewModel;

use App\TaskManager\Domain\Entity\Task\Task;

class ListTasksJsonViewModel
{

    public function __construct(
        public ?array $tasks = null,
    )
    {
    }

}

?>