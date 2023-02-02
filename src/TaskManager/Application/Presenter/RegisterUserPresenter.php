<?php 

namespace App\TaskManager\Application\Presenter;

use App\TaskManager\Domain\UseCase\Register\RegisterUserResponse;
use App\TaskManager\Domain\UseCase\Register\RegisterUserPresenterInterface;

class RegisterUserPresenter implements RegisterUserPresenterInterface
{

    private RegisterUserJsonViewModel $viewModel;

    public function present(RegisterUserResponse $response): void
    {
        $this->viewModel = new RegisterUserJsonViewModel();
        if ($response->getErrors()) {
            $this->viewModel->errors = $response->getErrors();
        }
        if ($response->getUser()) {
            $this->viewModel->user = $response->getUser();
        }

    }

    public function viewModel(): RegisterUserJsonViewModel
    {
        return $this->viewModel;
    }

    
}
?>