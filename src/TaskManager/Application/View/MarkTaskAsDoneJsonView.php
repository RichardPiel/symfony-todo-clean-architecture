<?php 

namespace App\TaskManager\Application\View;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\TaskManager\Application\Presenter\MarkTaskAsDoneJsonViewModel;

class MarkTaskAsDoneJsonView
{

    public function generateView(MarkTaskAsDoneJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse([
            'response' => $viewModel,
        ]);
    }


}

?>