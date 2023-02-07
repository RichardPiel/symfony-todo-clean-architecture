<?php 

namespace App\TaskManager\Application\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\TaskManager\Application\View\CreateTagJsonView;
use App\TaskManager\Infrastructure\Security\SecurityUser;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\TaskManager\Domain\UseCase\CreateTag\CreateTagRequest;
use App\TaskManager\Domain\UseCase\CreateTag\CreateTagUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\TaskManager\Domain\UseCase\CreateTag\CreateTagPresenterInterface;

#[Route('/api/tags', name: 'app_create_tag', methods: ['POST'])]
class CreateTagController extends AbstractController
{

    public function __construct(
        private CreateTagUseCase $createTagUseCase,
        private CreateTagJsonView $createTagJsonView,
        private CreateTagPresenterInterface $createTagPresenter

    )
    {}

    public function __invoke(Request $request, #[CurrentUser] ?SecurityUser $user)
    {

        $tagRequest = new CreateTagRequest(
            $request->get('name'),
            $user->getUser()
        );

        $this->createTagUseCase->execute($tagRequest, $this->createTagPresenter);

        return $this->createTagJsonView->generateView($this->createTagPresenter->viewModel());

    }
}

?>