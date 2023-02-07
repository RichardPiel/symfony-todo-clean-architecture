<?php 

namespace App\TaskManager\Domain\UseCase\ListTasks;

use App\TaskManager\Domain\Repository\TaskRepositoryInterface;
use App\TaskManager\Domain\UseCase\ListTasks\ListTasksResponse;

class ListTasksUseCase
{
    public function __construct(
        private ListTasksPresenterInterface $presenter,
        private TaskRepositoryInterface $repository
    )
    {}

    public function execute(ListTasksRequest $request): void
    {
        $tasks = $this->repository->findBy(['user' => $request->getUser()]);

        $response = new ListTasksResponse();
        $response->setTasks($tasks);

        $this->presenter->present($response);
    }
}

?>