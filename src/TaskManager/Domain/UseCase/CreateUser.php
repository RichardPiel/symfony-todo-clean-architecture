<?php

namespace App\TaskManager\Domain\UseCase;

use App\TaskManager\Domain\Entity\User;
use App\TaskManager\Domain\Entity\UserEmail;
use App\TaskManager\Domain\Entity\UserId;
use App\TaskManager\Domain\Entity\UserPassword;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;
use App\TaskManager\Domain\DTO\CreateUserDTO;
use Ramsey\Uuid\Uuid;

class CreateUser
{

    public function __construct(public UserRepositoryInterface $userRepository)
    {}

    public function execute(CreateUserDTO $userDTO): User
    {
        $user = new User(
            new UserId(Uuid::uuid4()->toString()),
            UserEmail::fromString($userDTO->getEmail()),
        );

        $user->setPassword(UserPassword::fromString($userDTO->getPassword()));

        $this->userRepository->save($user);

        return $user;
    }
}

?>