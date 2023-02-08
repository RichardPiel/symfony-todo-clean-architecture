<?php

namespace App\Tests\TaskManager\Infrastructure\Security;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Infrastructure\Security\SecurityUser;

class SecurityUsertest extends KernelTestCase
{

    public function testGetUser()
    {
        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('test@test.com')
        );
        $securityUser = new SecurityUser($user);
        $this->assertInstanceOf(User::class, $securityUser->getUser());
    }
    public function testGetUuid()
    {
        $uuid = UserId::fromString(Uuid::uuid4());
        $user = new User(
            $uuid,
            UserEmail::fromString('test@test.com')
        );
        $securityUser = new SecurityUser($user);
        $this->assertEquals($uuid->getValue(), $securityUser->getUuid());
    }

    public function testGetPassword()
    {
        $uuid = UserId::fromString(Uuid::uuid4());
        $user = new User(
            $uuid,
            UserEmail::fromString('test@test.com')
        );
        $user->setPassword('test');
        $securityUser = new SecurityUser($user);
        $this->assertEquals('test', $securityUser->getPassword());
    }

    public function testGetRoles()
    {
        $uuid = UserId::fromString(Uuid::uuid4());
        $user = new User(
            $uuid,
            UserEmail::fromString('test@test.com')
        );
        $securityUser = new SecurityUser($user);
        $this->assertEquals(['ROLE_USER'], $securityUser->getRoles());
    }
    public function testEraseCredentials()
    {
        $uuid = UserId::fromString(Uuid::uuid4());
        $user = new User(
            $uuid,
            UserEmail::fromString('test@test.com')
        );
        $securityUser = new SecurityUser($user);
        $this->assertNull($securityUser->eraseCredentials());
    }

}

?>