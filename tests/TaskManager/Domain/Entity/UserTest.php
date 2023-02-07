<?php

namespace App\Tests\TaskManager\Domain\Entity;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\User\UserEmail;
use App\TaskManager\Domain\Entity\User\UserId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testSetUuid(): void
    {
        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('mail@test.com')
        );

        $newUuid = UserId::fromString(Uuid::uuid4());
        $user->setUuid($newUuid);

        $this->assertEquals($newUuid, $user->getUuid());
    }

    public function testSetEmail(): void
    {
        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('mail@test.com')
        );

        $user->setEmail(UserEmail::fromString('newmail@gmail.com'));

        $this->assertEquals('newmail@gmail.com', $user->getEmail());
    }
}
