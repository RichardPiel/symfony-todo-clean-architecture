<?php 

namespace App\TaskManager\Application\View;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\TaskManager\Application\ViewModel\CreateTagJsonViewModel;

class CreateTagJsonView
{
    public function generateView(CreateTagJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse([
            'response' => $viewModel,
        ]);
    }
}


?>