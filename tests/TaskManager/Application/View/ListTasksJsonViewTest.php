<?php
use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\Task\TaskId;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Application\View\ListTasksJsonView;
use App\TaskManager\Application\ViewModel\ListTasksJsonViewModel;

class ListTasksJsonViewTest extends KernelTestCase
{
    private ListTasksJsonViewModel $viewModel;
    private ListTasksJsonView $view;

    public function setUp(): void
    {
        $this->viewModel = $this->createMock(ListTasksJsonViewModel::class);
        $this->view = new ListTasksJsonView();
    }

    public function testGenerateViewModel()
    {
        $task = new Task(TaskId::fromString(Uuid::uuid4()), 'My task');
        $task->setContent('My task content');
        $this->viewModel->tasks = [$task];

        $response = $this->view->generateView($this->viewModel);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertJson($response->getContent());
        $array = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('response', $array);
        $this->assertArrayHasKey('tasks', $array['response']);
        $this->assertEquals($this->viewModel->tasks, [$task]);


    }
}
?>