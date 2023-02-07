<?php 

namespace App\TaskManager\Application\Presenter;

use App\TaskManager\Domain\UseCase\ListTasks\ListTasksRequest;
use App\TaskManager\Domain\UseCase\ListTasks\ListTasksResponse;
use App\TaskManager\Application\ViewModel\CreateTagJsonViewModel;
use App\TaskManager\Application\ViewModel\ListTasksJsonViewModel;
use App\TaskManager\Domain\UseCase\ListTasks\ListTasksPresenterInterface;


class ListTasksPresenter implements ListTasksPresenterInterface
{

    private ListTasksJsonViewModel $viewModel;


    public function present(ListTasksResponse $response): void
    {

        $this->viewModel = new ListTasksJsonViewModel();

        $this->viewModel->tasks = $response->getTasks();

    }

    public function viewModel(): ListTasksJsonViewModel
    {
        return $this->viewModel;
    }

}

?>