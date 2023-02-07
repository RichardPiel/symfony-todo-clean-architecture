<?php 

namespace App\TaskManager\Application\View;

use App\TaskManager\Application\ViewModel\ListTasksJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListTasksJsonView
{
    public function generateView(ListTasksJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse([
            'response' => $viewModel,
        ]);
    }
}


?>