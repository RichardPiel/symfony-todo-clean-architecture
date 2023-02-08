<?php

namespace App\Tests\TaskManager\Domain\Entity;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\Entity\Tag\TagId;
use App\TaskManager\Domain\Entity\Task\Task;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\Task\TaskId;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
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

    public function testSetGetPassword()
    {
        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('email@email.com')
        );

        $user->setPassword('password');
        $this->assertEquals('password', $user->getPassword());

    }

    public function testGetRoles()
    {
         $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('email@email.com')
        );

        $this->assertEquals(['ROLE_USER'], $user->getRoles());

    }

    public function testSetGetTasks()
    {
        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('email@email.com')
        );

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

        $user->setTasks([
            $task1,
            $task2
        ]);

        $this->assertEquals([$task1, $task2], $user->getTasks());

    }

    public function testSetGetsTags()
    {
        $user = new User(
            UserId::fromString(Uuid::uuid4()),
            UserEmail::fromString('email@email.com')
        );
        $tag = new Tag(TagId::fromString(Uuid::uuid4()), 'My tag');
        $tag1 = new Tag(TagId::fromString(Uuid::uuid4()), 'My tag');

        $user->setTags([
            $tag,
            $tag1
        ]);

        $this->assertEquals([$tag, $tag1], $user->getTags());

    }

}
