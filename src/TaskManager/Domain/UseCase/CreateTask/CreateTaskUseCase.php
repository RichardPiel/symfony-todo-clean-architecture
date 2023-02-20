<?php

namespace App\TaskManager\Domain\UseCase\CreateTask;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\Shared\Domain\Event\TaskCreatedEvent;
use App\Shared\Domain\Event\EventBusInterface;
use App\TaskManager\Domain\Entity\Task\TaskId;
use App\TaskManager\Domain\Repository\TagRepositoryInterface;
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
        private TagRepositoryInterface $tagRepository,
        private ExceedingNumberOfTasks $exceedingNumberOfTasks,
        private readonly EventBusInterface $eventBus,
    )
    {
    }

    public function execute(CreateTaskRequest $request, CreateTaskPresenterInterface $presenter)
    {
        $response = new CreateTaskResponse();
        $validator = new CreateTaskValidation($request);

        try {
            if (!$validator->isValid()) {
                $response->setErrors($validator->getErrors());
            } else {
                $task = $this->createTask($request);
                $response->setTaskUuid($task->getUuid());
            }
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
            TaskId::fromString(Uuid::uuid4()),
            $request->getName()
        );

        $task->setContent($request->getContent());

        $task->setUser($request->getUser());

        if ($request->getTags()) {
            $explodedTags = explode(',', $request->getTags());
            foreach ($explodedTags as $key => $tagId) {
                $tag = $this->tagRepository->findByIdAndUser($tagId, $request->getUser());
                if ($tag) {
                    $task->addTag($tag);
                }
            }
        }

        if ($request->getParentTaskId()) {
            $parentTask = $this->taskRepository->find($request->getParentTaskId());
            $task->setParent($parentTask);
        }

        $this->taskRepository->save($task);

        $task->registerEvent(
            new TaskCreatedEvent(
                $task->getUuid(),
                $task->getName(),
                $task->getUser()
            )
        );
        $this->eventBus->dispatch(...$task->releaseEvents());

        return $task;

    }

}

?>