<?php

namespace App\TaskManager\Application\Presenter;

use App\TaskManager\Domain\UseCase\CreateTag\CreateTagResponse;
use App\TaskManager\Application\ViewModel\CreateTagJsonViewModel;
use App\TaskManager\Domain\UseCase\CreateTag\CreateTagPresenterInterface;

class CreateTagPresenter implements CreateTagPresenterInterface
{

    private CreateTagJsonViewModel $viewModel;

    public function present(
        CreateTagResponse $response
    ): void
    {
        $this->viewModel = new CreateTagJsonViewModel();
        if ($response->getErrors()) {
            $this->viewModel->errors = $response->getErrors();
        }
        if ($response->getTagUuid()) {
            $this->viewModel->tagUuid = $response->getTagUuid();
        }
    }

    public function viewModel(): CreateTagJsonViewModel
    {
        return $this->viewModel;
    }
}

?>