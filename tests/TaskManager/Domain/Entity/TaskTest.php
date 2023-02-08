<?php

namespace App\Tests\TaskManager\Domain\Entity;

use Ramsey\Uuid\Uuid;
use DateTimeImmutable;
use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\Entity\Tag\TagId;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\Task\TaskId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Domain\Exception\TaskAlreadyDoneException;

class TaskTest extends KernelTestCase
{
    public function testConstruct(): void
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $this->assertNotNull($task);
        $this->assertEquals('name', $task->getName());
    }

    public function testSetName(): void
    {
        $task = new Task(
           TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $task->setName('new name');

        $this->assertEquals('new name', $task->getName());
    }

    public function testSetContent(): void
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $task->setContent('new content');

        $this->assertEquals('new content', $task->getContent());
    }

    public function testSetUuid(): void
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $task->setUuid(
            TaskId::fromString(Uuid::uuid4()),
        );

        $this->assertNotNull($task->getUuid());
    }

    public function testGetCreatedAt(): void
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'name'
        );

        $this->assertNotNull($task->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getCreatedAt());
    }

    public function testCannotMarkAsDoneIfAlreadyDone(): void
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'test'
        );

        $task->markAsDone();

        $this->expectException(TaskAlreadyDoneException::class);

        $task->markAsDone();
    }

    public function testJsonSerialize()
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'test'
        );

        $task->setContent('content');

        $this->assertJson(json_encode($task));
    }

    public function testSetGetUser()
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'test'
        );

        $user = $this->getMockBuilder(User::class)->getMock();
        $task->setUser($user);

        $this->assertEquals($user, $task->getUser());
    }

    public function testSetTags()
    {
        $tagId = TagId::fromString(Uuid::uuid4());

        $tag1 = new Tag($tagId, 'My tag');
        $tagId = TagId::fromString(Uuid::uuid4());

        $tag2 = new Tag($tagId, 'My tag 2');

        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'Ma tâche'
        );
        $task->setContent('Contenu de ma tâche');
        $task->setTags([$tag1, $tag2]);
        

        $this->assertEquals([$tag1, $tag2], $task->getTags());
    }

    public function testSetParentTask()
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'Ma tâche'
        );
        $task->setContent('Contenu de ma tâche');

        $parentTask = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'Ma tâche parente'
        );
        $parentTask->setContent('Contenu de ma tâche parente');

        $task->setParent($parentTask);

        $this->assertEquals($parentTask, $task->getParentTask());

    }

    public function testSetChildTasks()
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'Ma tâche'
        );
        $task->setContent('Contenu de ma tâche');

        $childTask = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'Ma tâche fille'
        );
        $childTask->setContent('Contenu de ma tâche fille');

        $childTask2 = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'Ma tâche fille'
        );
        $childTask2->setContent('Contenu de ma tâche fille');

        $task->setChildTasks([$childTask, $childTask2]);

        $this->assertEquals([$childTask, $childTask2], $task->getChildTasks());

    }

    public function testAdTag()
    {
        $task = new Task(
            TaskId::fromString(Uuid::uuid4()),
            'Ma tâche'
        );
        $task->setContent('Contenu de ma tâche');

        $tag = new Tag(
            TagId::fromString(Uuid::uuid4()),
            'Ma tâche'
        );

        $task->addTag($tag);

        $this->assertEquals([$tag], $task->getTags()->toArray());
    }
}
