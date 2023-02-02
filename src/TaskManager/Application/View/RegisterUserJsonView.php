<?php 

namespace App\TaskManager\Application\View;

use App\TaskManager\Application\Presenter\RegisterUserJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterUserJsonView {

    public function generateView(RegisterUserJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse([
            'response' => $viewModel,
        ]);
    }
}

?>