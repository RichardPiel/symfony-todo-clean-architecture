<?php 

namespace App\TaskManager\Application\View;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\TaskManager\Application\ViewModel\CreateTaskJsonViewModel;

class CreateTaskJsonView {

    public function generateView(CreateTaskJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse([
            'response' => $viewModel,
        ]);
    }

}

?>