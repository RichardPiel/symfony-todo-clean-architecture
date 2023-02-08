<?php 

namespace App\Tests\TaskManager\Domain\UseCase\Register;

use PHPUnit\Framework\TestCase;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;
use App\TaskManager\Domain\UseCase\Register\RegisterUserRequest;
use App\TaskManager\Domain\UseCase\Register\RegisterUserUseCase;
use App\TaskManager\Domain\UseCase\Register\Service\EmailAlreadyExist;
use App\TaskManager\Domain\UseCase\Register\RegisterUserPresenterInterface;

class RegisterUserUseCaseTest extends TestCase
{

    public function testExecute()
    {
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $emailAlreadyExist = $this->createMock(EmailAlreadyExist::class);
        $presenter = $this->createMock(RegisterUserPresenterInterface::class);

        $useCase = new RegisterUserUseCase($userRepository, $emailAlreadyExist);

        $request = new RegisterUserRequest('example@email.com', 'password');

        $emailAlreadyExist->expects($this->once())
            ->method('check')
            ->with('example@email.com')
            ->willReturn(false);

        $userRepository->expects($this->once())
            ->method('save');

        $presenter->expects($this->once())
            ->method('present');

        $useCase->execute($request, $presenter);
    }

    public function testExecuteWithEmailAlreadyExistException()
    {
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $emailAlreadyExist = $this->createMock(EmailAlreadyExist::class);
        $presenter = $this->createMock(RegisterUserPresenterInterface::class);

        $useCase = new RegisterUserUseCase($userRepository, $emailAlreadyExist);

        $request = new RegisterUserRequest('example@email.com', 'password');

        $emailAlreadyExist->expects($this->once())
            ->method('check')
            ->with('example@email.com')
            ->willReturn(true);

        $userRepository->expects($this->never())
            ->method('save');

        $presenter->expects($this->once())
            ->method('present')
            ->with($this->callback(function ($response) {
                $this->assertArrayHasKey('email', $response->getErrors());
                $this->assertEquals('Email already exists!', $response->getError('email'));

                return true;
            }));

        $useCase->execute($request, $presenter);
    }
}

?>