<?php

namespace App\Tests\TaskManager\Application\Presenter;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\Task\TaskId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Application\Presenter\MarkTaskAsDonePresenter;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone\MarkTaskAsDoneResponse;
use App\TaskManager\Application\ViewModel\MarkTaskAsDoneJsonViewModel;

class MarkTaskAsDonePresenterTest extends KernelTestCase
{

    private MarkTaskAsDoneJsonViewModel $viewModel;
    private MarkTaskAsDonePresenter $presenter;

    public function setUp(): void
    {
        $this->viewModel = $this->createMock(MarkTaskAsDoneJsonViewModel::class);
        $this->presenter = new MarkTaskAsDonePresenter();
    }

    public function testPresent()
    {
        $response = $this->createMock(MarkTaskAsDoneResponse::class);

        $response->expects($this->exactly(2))
            ->method('getErrors')
            ->willReturn(['error']);

        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $response->expects($this->exactly(2))
            ->method('getTask')
            ->willReturn(
                $task
            );

        $this->presenter->present($response);

        $this->assertEquals($this->presenter->viewModel()->errors, ['error']);
        $this->assertEquals($this->presenter->viewModel()->task, $task);

    }

}

?>