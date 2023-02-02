<?php

use App\TaskManager\Domain\Entity\User\UserEmail;
use App\TaskManager\Domain\Entity\User\UserId;
use PHPUnit\Framework\TestCase;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskRequest;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskUseCase;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskPresenterInterface;
use App\TaskManager\Domain\UseCase\CreateTask\Service\ExceedingNumberOfTasks;
use Ramsey\Uuid\Uuid;

class CreateTaskUseCaseTest extends TestCase
{
    private $taskRepository;
    private $createTaskUseCase;

    protected function setUp(): void
    {
        $this->taskRepository = $this->createMock(TaskRepositoryInterface::class);
        $exceedingNumberOfTasks = $this->createMock(ExceedingNumberOfTasks::class);
        $this->createTaskUseCase = new CreateTaskUseCase($this->taskRepository, $exceedingNumberOfTasks);
    }

    public function testExecuteShouldCreateTaskSuccessfully()
    {
        $request = new CreateTaskRequest(
            'Name',
            'Content',
            new User(
                new UserId(Uuid::uuid4()),
                UserEmail::fromString('test@mail.com')
            )
        );
        $exceedingNumberOfTasks = $this->createMock(ExceedingNumberOfTasks::class);
        $exceedingNumberOfTasks->method("check")->willReturn(false);
        $presenter = $this->createMock(CreateTaskPresenterInterface::class);
        $presenter->expects($this->once())
            ->method('present')
            ->with($this->callback(function ($response) {
                dd($response);
                return !$response->hasError();
            }));

        $this->taskRepository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Task::class));

        $this->createTaskUseCase->execute($request, $presenter);
    }

}