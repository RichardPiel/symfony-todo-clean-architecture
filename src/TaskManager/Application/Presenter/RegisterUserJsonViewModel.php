<?php

namespace App\TaskManager\Application\Presenter;

use App\TaskManager\Domain\Entity\User\User;

class RegisterUserJsonViewModel
{

    public function __construct(
        public ?array $errors = null,
        public ?User $user = null,
    )
    {}

}


?>