<?php

namespace App\TaskManager\Domain\UseCase\Register;

use App\TaskManager\Domain\Validator\Validator;
use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Mailer\UserMailer;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use App\TaskManager\Domain\Mailer\MailerInterface;
use App\Shared\Domain\Service\PasswordRequirements;
use App\TaskManager\Domain\Entity\User\UserPassword;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;
use App\TaskManager\Domain\Exception\EmailAlreadyExistException;
use App\TaskManager\Domain\UseCase\Register\RegisterUserRequest;
use App\TaskManager\Domain\Exception\InvalidEmailFormatException;
use App\TaskManager\Domain\UseCase\Register\RegisterUserResponse;
use App\TaskManager\Domain\UseCase\Register\RegisterUserValidator;
use App\TaskManager\Domain\Exception\InvalidPasswordRequirementsException;
use App\TaskManager\Domain\UseCase\Register\RegisterUserPresenterInterface;
use App\TaskManager\Domain\UseCase\Register\Service\CheckIfEmailAlreadyUsed;

class RegisterUserUseCase
{

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private CheckIfEmailAlreadyUsed $emailAlreadyExist,
        private PasswordRequirements $passwordRequirements,
        private UserMailer $mailer
    )
    {
    }

    public function execute(RegisterUserRequest $request, RegisterUserPresenterInterface $presenter): void
    {

        $validator = new Validator($request);
        $validator
            ->add('email', 'NotEmpty', ['message' => 'Email is required'])
            ->add('email', 'IsEmail', ['message' => 'Email is not valid'])
            ->add('password', 'NotEmpty', ['message' => 'Password is required'])
            ->add('confirm_password', 'NotEmpty', ['message' => 'Confirm password is required'])
            ->add('password', 'NotEqual', [
                'message' => 'Confirm password is not equal to password',
                'rule' => function ($value, $context) {
                    return
                        isset($context->confirmPassword) &&
                        $value === $context->confirmPassword;
                }
            ])
            ->validate();


        $registerUserResponse = new RegisterUserResponse();

        if (!$validator->isValid()) {
            $registerUserResponse->setErrors($validator->getErrors());
        } else {
            $user = $this->saveUser($request);
            $registerUserResponse->setUserUuid($user->getUuid());
            $this->mailer->sendWelcome($user);
        }
        // try {
        //     $user = $this->saveUser($request);
        //     $registerUserResponse->setUserUuid($user->getUuid());
        //     $this->mailer->sendWelcome($user);
        // } catch (EmailAlreadyExistException | InvalidEmailFormatException $e) {
        //     $registerUserResponse->setError('email', $e->getMessage());
        // } catch (InvalidPasswordRequirementsException $e) {
        //     $registerUserResponse->setError('password', $e->getMessage());
        // }

        $presenter->present($registerUserResponse);
    }

    private function saveUser(RegisterUserRequest $request): User
    {
        if ($this->emailAlreadyExist->check($request->getEmail())) {
            throw new EmailAlreadyExistException();
        }
        $this->passwordRequirements->check($request->getPassword(), $request->getConfirmPassword());

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