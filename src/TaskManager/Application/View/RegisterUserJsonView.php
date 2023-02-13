<?php

namespace App\TaskManager\Application\View;

use App\TaskManager\Application\ViewModel\RegisterUserJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterUserJsonView
{

    public function generateView(RegisterUserJsonViewModel $viewModel, int $httpCode = 200): JsonResponse
    {
        return new JsonResponse([
            'response' => $viewModel,
        ], $httpCode);
    }
}

?>