<?php

namespace App\TaskManager\Application\Controller;

use App\TaskManager\Domain\DTO\CreateUserDTO;
use Symfony\Component\HttpFoundation\Request;
use App\TaskManager\Domain\UseCase\CreateUser;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    public function __construct(private CreateUser $createUser)
    {
    }

    #[Route('/users/create', name: 'app_create_user', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $createUserDTO = new CreateUserDTO(
            (string) $request->request->get('email'),
            (string) $request->request->get('password')
        );

        $userCreated = $this->createUser->execute($createUserDTO);

        return new JsonResponse([
            'status' => 'ok',
            'user' => $userCreated
        ]);
    }
}
