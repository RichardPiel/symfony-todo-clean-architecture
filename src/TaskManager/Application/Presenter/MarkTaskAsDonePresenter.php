<?php

namespace App\TaskManager\Application\Presenter;

use App\TaskManager\Application\ViewModel\MarkTaskAsDoneJsonViewModel;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone\MarkTaskAsDoneResponse;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone\MarkTaskAsDonePresenterInterface;

class MarkTaskAsDonePresenter implements MarkTaskAsDonePresenterInterface
{

    private MarkTaskAsDoneJsonViewModel $viewModel;

    public function present(MarkTaskAsDoneResponse $response): void
    {
        $this->viewModel = new MarkTaskAsDoneJsonViewModel();

        if ($response->getErrors()) {
            $this->viewModel->errors = $response->getErrors();
        }

        if ($response->getTask()) {
            $this->viewModel->task = $response->getTask();
        }

    }
    
    public function viewModel(): MarkTaskAsDoneJsonViewModel
    {
        return $this->viewModel;
    }

}

?>