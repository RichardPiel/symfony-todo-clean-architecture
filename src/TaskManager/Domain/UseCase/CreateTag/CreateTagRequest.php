<?php 

namespace App\TaskManager\Domain\UseCase\CreateTag;

use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\RequestInterface;

class CreateTagRequest implements RequestInterface
{
    
    public function __construct(
        protected string $name,
        protected User $user
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }
    
    public function getUser(): User
    {
        return $this->user;
    }

}


?>