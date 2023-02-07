<?php

namespace Tests\App\TaskManager\Domain\UseCase\CreateTag\Service;

use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\Entity\Tag\TagId;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use App\TaskManager\Domain\Repository\TagRepositoryInterface;
use App\TaskManager\Domain\UseCase\CreateTag\Service\TagAlreadyExist;

class TagAlreadyExistTest extends TestCase
{

    public function testCheckTagAlreadyExist()
    {
        $repositoryMock = $this->getMockBuilder(TagRepositoryInterface::class)->getMock();

        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('test@test.com')
        );

        $service = new TagAlreadyExist($repositoryMock);

        // Test tag exists 
        $repositoryMock
            ->expects($this->once())
            ->method('findBy')
            ->willReturn([new Tag(TagId::fromString(Uuid::uuid4()), 'Tag')]);

        $this->assertTrue($service->check('Tag', $user));

    }

    public function testCheckTagNotAlreadyExist()
    {

        $repositoryMock = $this->getMockBuilder(TagRepositoryInterface::class)->getMock();

        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('test@test.com')
        );

        $service = new TagAlreadyExist($repositoryMock);

        // Test tag does not exist 
        $repositoryMock
            ->expects($this->once())
            ->method('findBy')
            ->willReturn([]);

        $this->assertFalse($service->check('Tag', $user));

    }
}