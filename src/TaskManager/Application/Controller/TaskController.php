<?php

namespace App\TaskManager\Application\Controller;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task;
use App\TaskManager\Domain\Entity\User;
use App\TaskManager\Domain\Entity\TaskId;
use App\TaskManager\Domain\Entity\UserId;
use App\TaskManager\Domain\Entity\UserEmail;
use Symfony\Component\HttpFoundation\Request;
use App\TaskManager\Domain\UseCase\CreateTask;
use Symfony\Component\Routing\Annotation\Route;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/tasks", controller="App\TaskManager\Application\Controller\TaskController")
 */
class TaskController extends AbstractController
{


    public function __construct(private CreateTask $createTask, private MarkTaskAsDone $markTaskAsDone)
    {
    }

    #[Route('/tasks/create', name: 'app_create_task', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {


        $name = $request->request->get('name');
        $content = $request->request->get('content');

        $task = new Task(
            new TaskId(Uuid::uuid4()->toString()),
            $name,
            $content
        );
        $this->createTask->execute($task);

        return new JsonResponse([
            'status' => 'ok',
        ]);
    }

    #[Route('/tasks/{taskUuid}/mark-as-done', name: 'app_mark_task_as_done', methods: ['GET'])]
    public function markTaskAsDone(string $taskUuid): JsonResponse
    {
        $this->markTaskAsDone->execute($taskUuid);
        return new JsonResponse([
            'status' => 'ok',
        ]);
    }


}