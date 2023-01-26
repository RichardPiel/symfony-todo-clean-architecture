<?php

namespace App\TaskManager\Application\Controller;

use App\TaskManager\Domain\DTO\CreateTaskDTO;
use Symfony\Component\HttpFoundation\Request;
use App\TaskManager\Domain\UseCase\CreateTask;
use Symfony\Component\Routing\Annotation\Route;
use App\TaskManager\Domain\UseCase\MarkTaskAsDone;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    public function __construct(private CreateTask $createTask, private MarkTaskAsDone $markTaskAsDone)
    {
    }

    #[Route('/tasks/create', name: 'app_create_task', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $name = (string) $request->request->get('name');
        $content = (string) $request->request->get('content');
        $userId = (string) $request->request->get('userId');
        $taskDTO = new CreateTaskDTO(
            $name,
            $content,
            $userId
        );
        $this->createTask->execute($taskDTO);

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
