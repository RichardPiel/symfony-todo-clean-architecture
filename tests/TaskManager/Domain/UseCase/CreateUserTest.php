<?php

namespace App\Tests\TaskManager\Domain\UseCase;

use App\TaskManager\Domain\UseCase\CreateUser;
use App\TaskManager\Domain\DTO\CreateUserDTO;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Tests\TaskManager\Infrastructure\Repository\InMemoryUserRepository;

class CreateUserTest extends KernelTestCase
{
    /**
     * @return void
     */
    public function testCreateUser(): void
    {
        $inMemoryUserRepository = new InMemoryUserRepository();

        $userDTO = new CreateUserDTO(
            'r.piel@webandcow.com',
            'password'
        );

        (new CreateUser($inMemoryUserRepository))->execute($userDTO);

        $this->assertNotNull($inMemoryUserRepository->findByEmail('r.piel@webandcow.com'));
    }
}
