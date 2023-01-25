<?php

namespace App\TaskManager\Application\Controller;

use App\TaskManager\Domain\DTO\CreateUserDTO;
use Symfony\Component\HttpFoundation\Request;
use App\TaskManager\Domain\UseCase\CreateUser;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/users", controller="App\TaskManager\Application\Controller\UserController")
 */
class UserController extends AbstractController
{

    public function __construct(private CreateUser $createUser)
    {
    }

    #[Route('/users/create', name: 'app_create_user', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $createUserDTO = new CreateUserDTO(
            $request->request->get('email'),
            $request->request->get('password')
        );

        $userCreated = $this->createUser->execute($createUserDTO);

        return new JsonResponse([
            'status' => 'ok',
            'user' => $userCreated
        ]);

    }

}