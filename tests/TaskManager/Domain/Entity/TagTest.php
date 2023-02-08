<?php

namespace App\Tests\TaskManager\Domain\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Rfc4122\UuidInterface;
use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\Entity\Tag\TagId;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\Task\TaskId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Domain\Exception\InvalidUuidException;

class TagTest extends KernelTestCase
{

    public function testConstruct(): void
    {
        $task = new Tag(
            TagId::fromString(Uuid::uuid4()),
            'name'
        );

        $this->assertNotNull($task);
        $this->assertEquals('name', $task->getName());
    }

    public function testConstructBadUuid(): void
    {
        $this->expectException(InvalidUuidException::class);

        $uuidMock = $this->getMockBuilder(UuidInterface::class)->getMock();

        $uuidMock
            ->expects($this->once())
            ->method('toString')
            ->willReturn('test');

        $task = new Tag(
            TagId::fromString($uuidMock),
            'name'
        );

    }

    public function testGetUuid()
    {
        $tagId = TagId::fromString(Uuid::uuid4());

        $tag = new Tag($tagId, 'My tag');

        $this->assertEquals($tagId, $tag->getUuid());
    }

    public function testSetUuid()
    {
        $tagId = TagId::fromString(Uuid::uuid4());

        $tag = new Tag($tagId, 'My tag');

        $tag->setUuid('456');

        $this->assertEquals('456', $tag->getUuid());
    }

    public function testGetName()
    {
        $tagId = TagId::fromString(Uuid::uuid4());

        $tag = new Tag($tagId, 'My tag');

        $this->assertEquals('My tag', $tag->getName());
    }

    public function testSetName()
    {
        $tagId = TagId::fromString(Uuid::uuid4());

        $tag = new Tag($tagId, 'My tag');

        $tag->setName('Your tag');

        $this->assertEquals('Your tag', $tag->getName());
    }

    public function testSetTasks()
    {
        $tagId = TagId::fromString(Uuid::uuid4());

        $tag = new Tag($tagId, 'My tag');

        $task1 = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'Ma tâche'
        );
        $task1->setContent('Contenu de ma tâche');
        $task2 = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'Ma tâche'
        );
        $task2->setContent('Contenu de ma tâche');

        $tag->setTasks([
            $task1,
            $task2
        ]);

        $this->assertEquals([$task1, $task2], $tag->getTasks());
    }

    public function testJsonSerialize()
    {
        $tagId = TagId::fromString(Uuid::uuid4());

        $tag = new Tag($tagId, 'My tag');

        $this->assertEquals(['uuid' => $tagId->getValue(), 'name' => 'My tag'], $tag->jsonSerialize());
    }

    public function testSetAndGetUser()
    {
        $user = $this->getMockBuilder(User::class)->getMock();

        $tagId = TagId::fromString(Uuid::uuid4());

        $tag = new Tag($tagId, 'My tag');

        $tag->setUser($user);

        $this->assertEquals($user, $tag->getUser());
        $this->assertInstanceOf(User::class, $tag->getUser());

    }

}