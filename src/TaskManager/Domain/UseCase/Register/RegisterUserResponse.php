<?php

namespace App\TaskManager\Domain\UseCase\Register;

use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\UseCase\ResponseTrait;

class RegisterUserResponse
{

    use ResponseTrait;

    public ?string $userUuid;

    /**
     * @return string|null
     */
    public function getUserUuid(): ?string
    {
        return $this->userUuid;
    }

    /**
     * @param string|null $userUuid
     * @return void
     */
    public function setUserUuid(?string $userUuid): void
    {
        $this->userUuid = $userUuid;
    }

}

?>