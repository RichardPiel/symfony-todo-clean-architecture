<?php

namespace App\TaskManager\Application\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\TaskManager\Infrastructure\Security\SecurityUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'app_api_login', methods: ['POST'])]
    public function index(#[CurrentUser] ?SecurityUser $user): JsonResponse
    {
       if (null === $user) {
             return $this->json([
                 'message' => 'missing credentials',
             ], Response::HTTP_UNAUTHORIZED);
        }
        $token = "";
        return $this->json([
                    'user'  => $user->getUserIdentifier(),
                    'token' => $token,
                ]);
    }
}
