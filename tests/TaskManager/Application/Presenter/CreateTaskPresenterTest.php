<?php

namespace App\Tests\TaskManager\Application\Presenter;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\Task\TaskId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Application\Presenter\CreateTaskPresenter;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskResponse;
use App\TaskManager\Application\ViewModel\CreateTaskJsonViewModel;

class CreateTaskPresenterTest extends KernelTestCase
{

    private CreateTaskJsonViewModel $viewModel;
    private CreateTaskPresenter $presenter;

    public function setUp(): void
    {
        $this->viewModel = $this->createMock(CreateTaskJsonViewModel::class);
        $this->presenter = new CreateTaskPresenter();
    }

    public function testPresent()
    {
        $response = $this->createMock(CreateTaskResponse::class);

        $response->expects($this->exactly(2))
            ->method('getErrors')
            ->willReturn(['error']);

        $taskUuid = TaskId::fromString(Uuid::uuid4());
        $task = new Task(
            $taskUuid,
            'name'
        );
        
        $response->expects($this->exactly(2))
            ->method('getTaskUuid')
            ->willReturn(
                $taskUuid->getValue()
            );

        $this->presenter->present($response);

        $this->assertEquals($this->presenter->viewModel()->errors, ['error']);
        $this->assertEquals($this->presenter->viewModel()->taskUuid, $task->getUuid());

    }

}

?>