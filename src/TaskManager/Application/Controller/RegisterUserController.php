<?php

namespace App\TaskManager\Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\TaskManager\Application\View\RegisterUserJsonView;
use App\TaskManager\Application\Presenter\RegisterUserPresenter;
use App\TaskManager\Domain\UseCase\Register\RegisterUserRequest;
use App\TaskManager\Domain\UseCase\Register\RegisterUserUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/register', name: 'app_register', methods: ['POST'])]
final class RegisterUserController extends AbstractController
{

    public function __construct(
        private RegisterUserUseCase $registerUseCase,
        private RegisterUserPresenter $registerUserPresenter,
        private RegisterUserJsonView $registerView
    )
    {}

    public function __invoke(Request $request): JsonResponse
    {
        $registerUserRequest = new RegisterUserRequest(
            $request->get('email'),
            $request->get('password')
        );
        $this->registerUseCase->execute($registerUserRequest, $this->registerUserPresenter);

        return $this->registerView->generateView($this->registerUserPresenter->viewModel());
    }

}
?>