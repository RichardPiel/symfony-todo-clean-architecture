<?php 

namespace App\Tests\TaskManager\Domain\Entity;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\User;
use App\TaskManager\Domain\Entity\UserEmail;
use App\TaskManager\Domain\Entity\UserId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    
    public function testSetUuid()
    {
        $user = new User(
            new UserId(Uuid::uuid4()->toString()),
            UserEmail::fromString('mail@test.com')
        );

        $newUuid = new UserId(Uuid::uuid4()->toString());
        $user->setUuid($newUuid);

        $this->assertEquals($newUuid, $user->getUuid());
    }

    public function testSetEmail()
    {
        $user = new User(
            new UserId(Uuid::uuid4()->toString()),
            UserEmail::fromString('mail@test.com')
        );

        $user->setEmail(UserEmail::fromString('newmail@gmail.com'));

        $this->assertEquals('newmail@gmail.com', $user->getEmail());
    }

}

?>