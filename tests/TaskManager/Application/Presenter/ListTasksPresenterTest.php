<?php

namespace App\Tests\TaskManager\Application\Presenter;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\Task\TaskId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Application\Presenter\ListTasksPresenter;
use App\TaskManager\Domain\UseCase\ListTasks\ListTasksResponse;
use App\TaskManager\Application\ViewModel\ListTasksJsonViewModel;

class ListTasksPresenterTest extends KernelTestCase
{

    private ListTasksJsonViewModel $viewModel;
    private ListTasksPresenter $presenter;

    public function setUp(): void
    {
        $this->viewModel = $this->createMock(ListTasksJsonViewModel::class);
        $this->presenter = new ListTasksPresenter();
    }

    public function testPresent()
    {
        $response = $this->createMock(ListTasksResponse::class);

        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $response->expects($this->exactly(1))
            ->method('getTasks')
            ->willReturn(
                [$task]
            );

        $this->presenter->present($response);

        $this->assertEquals($this->presenter->viewModel()->tasks, [$task]);

    }

}

?>