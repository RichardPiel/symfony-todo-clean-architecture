<?php 

namespace App\TaskManager\Application\Presenter;

use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskResponse;
use App\TaskManager\Application\ViewModel\CreateTaskJsonViewModel;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskPresenterInterface;

class CreateTaskPresenter implements CreateTaskPresenterInterface
{

    private CreateTaskJsonViewModel $viewModel;

    public function present(CreateTaskResponse $response): void
    {
        $this->viewModel = new CreateTaskJsonViewModel();

        if ($response->getErrors()) {
            $this->viewModel->errors = $response->getErrors();
        }

        if ($response->getTask()) {
            $this->viewModel->task = $response->getTask();
        }

    }
    
    public function viewModel(): CreateTaskJsonViewModel
    {
        return $this->viewModel;
    }

}

?>