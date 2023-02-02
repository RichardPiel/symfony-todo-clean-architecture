<?php 

namespace App\TaskManager\Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\TaskManager\Infrastructure\Security\SecurityUser;
use App\TaskManager\Application\View\MarkTaskAsDoneJsonView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone\MarkTaskAsDoneRequest;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone\MarkTaskAsDoneUseCase;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone\MarkTaskAsDonePresenterInterface;


#[Route('/api/tasks/{uuid}/done', name: 'app_mark_task_as_done', methods: ['GET'])]
final class MarkTaskAsDoneController extends AbstractController
{

    public function __construct(
        private MarkTaskAsDoneUseCase $markTaskAsDoneUseCase,
        private MarkTaskAsDonePresenterInterface $markTaskAsDonePresenter,
        private MarkTaskAsDoneJsonView $markTaskAsDoneJsonView
    )
    {}

    public function __invoke(Request $request, #[CurrentUser] ?SecurityUser $user, string $uuid): JsonResponse
    {
        $request = new MarkTaskAsDoneRequest(
            $uuid,
            $user->getUser()
        );

        $this->markTaskAsDoneUseCase->execute($request, $this->markTaskAsDonePresenter);

        return $this->markTaskAsDoneJsonView->generateView($this->markTaskAsDonePresenter->viewModel());

    }
}

?>