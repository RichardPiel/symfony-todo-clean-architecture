<?php

namespace App\TaskManager\Domain\UseCase\Register;

use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\UseCase\ResponseTrait;

class RegisterUserResponse
{

    use ResponseTrait;

    protected ?User $user = null;

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return void
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

}

?>