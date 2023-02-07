<?php

namespace App\Tests\TaskManager\Application\Presenter;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\Task\TaskId;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Application\Presenter\RegisterUserPresenter;
use App\TaskManager\Application\ViewModel\RegisterUserJsonViewModel;
use App\TaskManager\Domain\UseCase\Register\RegisterUserResponse;

class RegisterUserPresenterTest extends KernelTestCase
{

    private RegisterUserJsonViewModel $viewModel;
    private RegisterUserPresenter $presenter;

    public function setUp(): void
    {
        $this->viewModel = $this->createMock(RegisterUserJsonViewModel::class);
        $this->presenter = new RegisterUserPresenter();
    }

    public function testPresent()
    {
        $response = $this->createMock(RegisterUserResponse::class);

        $response->expects($this->exactly(2))
            ->method('getErrors')
            ->willReturn(['error']);

        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('email@email.com'),
        );
        
        $response->expects($this->exactly(2))
            ->method('getUser')
            ->willReturn(
                $user
            );

        $this->presenter->present($response);

        $this->assertEquals($this->presenter->viewModel()->errors, ['error']);
        $this->assertEquals($this->presenter->viewModel()->user, $user);

    }

}

?>