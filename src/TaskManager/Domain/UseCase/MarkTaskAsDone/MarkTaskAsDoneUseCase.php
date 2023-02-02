<?php

namespace App\TaskManager\Domain\UseCase\MarkTaskAsDone;

use DateTimeImmutable;
use App\TaskManager\Domain\Exception\TaskNotFoundException;
use App\TaskManager\Domain\Exception\TaskAlreadyDoneException;
use App\TaskManager\Domain\Repository\TaskRepositoryInterface;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone\MarkTaskAsDoneRequest;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone\MarkTaskAsDonePresenterInterface;

class MarkTaskAsDoneUseCase {

    public function __construct(
        private TaskRepositoryInterface $taskRepository
    )
    {}

    public function execute(MarkTaskAsDoneRequest $request, MarkTaskAsDonePresenterInterface $presenter)
    {
        $response = new MarkTaskAsDoneResponse();

        try {
            $task = $this->markAsDone($request);
            $response->setTask($task);
        } catch (TaskAlreadyDoneException $th) {
            $response->setError('name', $th->getMessage());
        }

        $presenter->present($response);
    }

    private function markAsDone(MarkTaskAsDoneRequest $request)
    {
        $task = $this->taskRepository->findById($request->getUuidTask());
        
        if (!$task) {
            throw new TaskNotFoundException;
        }

        if ($task->getDoneAt()) {
            throw new TaskAlreadyDoneException;
        }

        $task->setDoneAt(new DateTimeImmutable());

        $this->taskRepository->update($task);

        return $task;

    }


}

?>