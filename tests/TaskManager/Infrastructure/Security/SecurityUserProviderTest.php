<?php

namespace App\Tests\TaskManager\Infrastructure\Security;

use Exception;
use ReflectionClass;
use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\User\UserInterface;
use App\TaskManager\Infrastructure\Security\SecurityUser;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;
use App\TaskManager\Infrastructure\Security\SecurityUserProvider;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class SecurityUserProviderTest extends KernelTestCase
{
    private UserRepositoryInterface $userRepository;

    public function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
    }

    public function testSupportsClass()
    {
        $SecurityUserProvider = new SecurityUserProvider($this->userRepository);
        $this->assertTrue($SecurityUserProvider->supportsClass(SecurityUser::class));
    }

    public function testRefreshWithBadUser()
    {
        $this->expectException(UnsupportedUserException::class);

        $SecurityUserProvider = new SecurityUserProvider($this->userRepository);
        $user = $this->createMock(UserInterface::class);

        $SecurityUserProvider->refreshUser($user);

    }

    public function testRefreshUserNotExist()
    {

        $userRepository = $this->createMock(UserRepositoryInterface::class);

        $userRepository
            ->expects($this->once())
            ->method('findOneBy')
            ->with(['email' => 'test@test.com'])
            ->willReturn(null);

        $SecurityUserProvider = new SecurityUserProvider($userRepository);
        $securityUser = new SecurityUser(
            new User(
                UserId::fromString(Uuid::uuid4()),
                UserEmail::fromString('test@test.com')
            )
        );
        $this->expectException(Exception::class);

        $SecurityUserProvider->refreshUser($securityUser);

    }
    public function testRefreshUserExist()
    {

        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('test@test.com')
        );
        $userRepository
            ->expects($this->once())
            ->method('findOneBy')
            ->with(['email' => 'test@test.com'])
            ->willReturn($user);

        $SecurityUserProvider = new SecurityUserProvider($userRepository);
        $securityUser = new SecurityUser(
            $user
        );

       $response =  $SecurityUserProvider->refreshUser($securityUser);
        $this->assertInstanceOf(SecurityUser::class, $response);
    }

    public function testLoadUserByIdentifier()
    {

        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('test@test.com')
        );
        $userRepository
            ->expects($this->once())
            ->method('findOneBy')
            ->with(['email' => 'test@test.com'])
            ->willReturn($user);

        $SecurityUserProvider = new SecurityUserProvider($userRepository);
        $securityUser = new SecurityUser(
            $user
        );

        $response = $SecurityUserProvider->loadUserByIdentifier($securityUser->getUserIdentifier());
        $this->assertInstanceOf(SecurityUser::class, $response);
    }
}

?>