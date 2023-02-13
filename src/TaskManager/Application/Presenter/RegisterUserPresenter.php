<?php 

namespace App\TaskManager\Application\Presenter;

use App\TaskManager\Domain\UseCase\Register\RegisterUserResponse;
use App\TaskManager\Application\ViewModel\RegisterUserJsonViewModel;
use App\TaskManager\Domain\UseCase\Register\RegisterUserPresenterInterface;

class RegisterUserPresenter implements RegisterUserPresenterInterface
{

    private RegisterUserJsonViewModel $viewModel;
    private int $httpCode = 200;

    public function present(RegisterUserResponse $response): void
    {
        $this->viewModel = new RegisterUserJsonViewModel();
        if ($response->getErrors()) {
            $this->viewModel->errors = $response->getErrors();
            $this->setHttpCode(422);
        }
        if ($response->getUserUuid()) {
            $this->viewModel->userUuid = $response->getUserUuid();
            $this->setHttpCode(201);
        }

    }

    public function viewModel(): RegisterUserJsonViewModel
    {
        return $this->viewModel;
    }

    public function setHttpCode(int $code): void
    {
        $this->httpCode = $code;
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    
}
?>