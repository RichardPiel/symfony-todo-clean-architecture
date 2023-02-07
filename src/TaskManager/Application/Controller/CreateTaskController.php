<?php

namespace App\TaskManager\Application\Controller;

use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskPresenterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\TaskManager\Application\View\CreateTaskJsonView;
use App\TaskManager\Infrastructure\Security\SecurityUser;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskRequest;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/tasks', name: 'app_create_task', methods: ['POST'])]
final class CreateTaskController extends AbstractController
{

    public function __construct(
        private CreateTaskUseCase $createTaskUseCase,
        private CreateTaskPresenterInterface $createTaskPresenter,
        private CreateTaskJsonView $createTaskJsonView
    )
    {}

    public function __invoke(Request $request, #[CurrentUser] ?SecurityUser $user): JsonResponse
    {
        $taskRequest = new CreateTaskRequest(
            $request->get('name'),
            $user->getUser(),
            $request->get('content'),
            $request->get('parentTaskId'),
            $request->get('tags')
        );
 
        $this->createTaskUseCase->execute($taskRequest, $this->createTaskPresenter);

        return $this->createTaskJsonView->generateView($this->createTaskPresenter->viewModel());

    }
}

?>