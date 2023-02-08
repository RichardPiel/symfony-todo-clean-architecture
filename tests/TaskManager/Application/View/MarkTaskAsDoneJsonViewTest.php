<?php
use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\Task\TaskId;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Application\View\MarkTaskAsDoneJsonView;
use App\TaskManager\Application\ViewModel\MarkTaskAsDoneJsonViewModel;

class MarkTaskAsDoneJsonViewTest extends KernelTestCase
{
    private MarkTaskAsDoneJsonViewModel $viewModel;
    private MarkTaskAsDoneJsonView $view;

    public function setUp(): void
    {
        $this->viewModel = $this->createMock(MarkTaskAsDoneJsonViewModel::class);
        $this->view = new MarkTaskAsDoneJsonView();
    }

    public function testGenerateViewModel()
    {
        $this->viewModel->errors = ['error'];
        $task = new Task(TaskId::fromString(Uuid::uuid4()), 'My task');
        $task->setContent('My task content');
        $this->viewModel->task = $task;
        $response = $this->view->generateView($this->viewModel);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertJson($response->getContent());
        $array = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('response', $array);
        $this->assertArrayHasKey('errors', $array['response']);
        $this->assertArrayHasKey('task', $array['response']);


    }
}
?>