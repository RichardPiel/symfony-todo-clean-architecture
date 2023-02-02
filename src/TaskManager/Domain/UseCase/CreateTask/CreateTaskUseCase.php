<?php 

namespace App\TaskManager\Domain\UseCase\CreateTask;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\Task\TaskId;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskRequest;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskResponse;
use App\TaskManager\Domain\Exception\NumberOfTasksExceededException;
use App\TaskManager\Domain\UseCase\CreateTask\CreateTaskPresenterInterface;
use App\TaskManager\Domain\UseCase\CreateTask\Service\ExceedingNumberOfTasks;

class CreateTaskUseCase
{

    public function __construct(
        private TaskRepositoryInterface $taskRepository,
        private ExceedingNumberOfTasks $exceedingNumberOfTasks
    )
    {}

    public function execute(CreateTaskRequest $request, CreateTaskPresenterInterface $presenter)
    {
        $response = new CreateTaskResponse();

        try {
            $task = $this->createTask($request);
            $response->setTask($task);
        } catch (NumberOfTasksExceededException $th) {
            $response->setError('name', $th->getMessage());
        }

        $presenter->present($response);

    }

    private function createTask(CreateTaskRequest $request): Task
    {
        if ($this->exceedingNumberOfTasks->check($request->getUser())) {
            throw new NumberOfTasksExceededException();
        }

        $task = new Task(
            (new TaskId(Uuid::uuid4())),
            $request->getName()
        );

        $task->setContent($request->getContent());
        
        $task->setUser($request->getUser());

        $this->taskRepository->save($task);

        return $task;

    }

}

?>