<?php 

namespace App\TaskManager\Domain\UseCase\Register\Service;

use App\TaskManager\Domain\Repository\UserRepositoryInterface;

class EmailAlreadyExist {

    public function __construct(private UserRepositoryInterface $userRepository)
    {}

    public function check(string $email)
    {

        $user = $this->userRepository->findByEmail($email);

        if ($user) {
            return true;
        }

        return false;

    }

}

?>