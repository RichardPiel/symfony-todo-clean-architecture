<?php
namespace App\Tests\TaskManager\Domain\UseCase\CreateTask;

use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use App\TaskManager\Domain\Repository\TagRepositoryInterface;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskRequest;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskUseCase;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskPresenterInterface;
use App\TaskManager\Domain\UseCase\CreateTask\Service\ExceedingNumberOfTasks;

class CreateTaskUseCaseTest extends TestCase
{
    private TaskRepositoryInterface $taskRepository;
    private TagRepositoryInterface $tagRepository;
    private $createTaskUseCase;

    protected function setUp(): void
    {
        $this->taskRepository = $this->createMock(TaskRepositoryInterface::class);
        $this->tagRepository = $this->createMock(TagRepositoryInterface::class);
        $exceedingNumberOfTasks = $this->createMock(ExceedingNumberOfTasks::class);
        $this->createTaskUseCase = new CreateTaskUseCase($this->taskRepository, $this->tagRepository, $exceedingNumberOfTasks);
    }

    public function testExecuteShouldCreateTaskSuccessfully()
    {
        $request = new CreateTaskRequest(
            'Name',
            new User(
                UserId::fromString(Uuid::uuid4()),
                UserEmail::fromString('test@mail.com')
            )
        );
        $exceedingNumberOfTasks = $this->createMock(ExceedingNumberOfTasks::class);
        $exceedingNumberOfTasks->method("check")->willReturn(false);
        $presenter = $this->createMock(CreateTaskPresenterInterface::class);
        $presenter->expects($this->once())
            ->method('present')
            ->with($this->callback(function ($response) {
                return !$response->hasError();
            }));

        $this->taskRepository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Task::class));

        $this->createTaskUseCase->execute($request, $presenter);
    }

}