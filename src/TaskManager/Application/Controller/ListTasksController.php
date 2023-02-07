<?php 

namespace App\TaskManager\Application\Controller;
use App\TaskManager\Application\View\ListTasksJsonView;
use App\TaskManager\Domain\UseCase\ListTasks\ListTasksPresenterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\TaskManager\Application\Presenter\ListTasksPresenter;
use App\TaskManager\Domain\UseCase\ListTasks\ListTasksRequest;
use App\TaskManager\Domain\UseCase\ListTasks\ListTasksUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/tasks', name: 'list_tasks', methods: ['GET'])]
class ListTasksController extends AbstractController
{

    public function __construct(
        private ListTasksUseCase $useCase,
        private ListTasksPresenterInterface $presenter,
        private ListTasksJsonView $createTagJsonView
    )
    {
    }

    public function __invoke(#[CurrentUser] $user)
    {
        $request = new ListTasksRequest($user->getUser());

        $this->useCase->execute($request);

        return $this->createTagJsonView->generateView($this->presenter->viewModel());

    }


}

?>