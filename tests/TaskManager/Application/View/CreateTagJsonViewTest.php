<?php
use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\Entity\Tag\TagId;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\Task\TaskId;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Application\View\CreateTagJsonView;
use App\TaskManager\Application\ViewModel\CreateTagJsonViewModel;

class CreateTagJsonViewTest extends KernelTestCase
{
    private CreateTagJsonViewModel $viewModel;
    private CreateTagJsonView $view;

    public function setUp(): void
    {
        $this->viewModel = $this->createMock(CreateTagJsonViewModel::class);
        $this->view = new CreateTagJsonView();
    }

    public function testGenerateViewModel()
    {
        $this->viewModel->errors = ['error'];
        $tag = new Tag(TagId::fromString(Uuid::uuid4()), 'My tag');
        $this->viewModel->tag = $tag;
        $response = $this->view->generateView($this->viewModel);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertJson($response->getContent());
        $array = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('response', $array);
        $this->assertArrayHasKey('errors', $array['response']);
        $this->assertArrayHasKey('tag', $array['response']);


    }
}
?>