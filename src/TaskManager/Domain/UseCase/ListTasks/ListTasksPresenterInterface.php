<?php 

namespace App\TaskManager\Domain\UseCase\ListTasks;

interface ListTasksPresenterInterface
{
    public function present(ListTasksResponse $response);
}

?>