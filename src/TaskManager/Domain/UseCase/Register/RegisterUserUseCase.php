<?php

namespace App\TaskManager\Domain\UseCase\Register;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use App\TaskManager\Domain\Entity\User\UserPassword;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;
use App\TaskManager\Domain\Exception\EmailAlreadyExistException;
use App\TaskManager\Domain\UseCase\Register\RegisterUserRequest;
use App\TaskManager\Domain\Exception\InvalidEmailFormatException;
use App\TaskManager\Domain\UseCase\Register\RegisterUserResponse;
use App\TaskManager\Domain\UseCase\Register\Service\EmailAlreadyExist;
use App\TaskManager\Domain\UseCase\Register\RegisterUserPresenterInterface;

class RegisterUserUseCase
{

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private EmailAlreadyExist $emailAlreadyExist
    )
    {}

    public function execute(RegisterUserRequest $request, RegisterUserPresenterInterface $presenter): void
    {
        $registerUserResponse = new RegisterUserResponse();

        try {
            $user = $this->saveUser($request);
            $registerUserResponse->setUserUuid($user->getUuid());
        } catch (EmailAlreadyExistException | InvalidEmailFormatException $e) {
            $registerUserResponse->setError('email', $e->getMessage());
        }

        $presenter->present($registerUserResponse);
    }

    private function saveUser(RegisterUserRequest $request): User
    {
        if ($this->emailAlreadyExist->check($request->getEmail())) {
            throw new EmailAlreadyExistException();
        }

        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString($request->getEmail()),
        );

        $user->setPassword(UserPassword::fromString($request->getPassword()));

        $this->userRepository->save($user);

        return $user;

    }

}

?>