<?php 

namespace App\TaskManager\Domain\UseCase\Register\Service;

use App\TaskManager\Domain\Repository\UserRepositoryInterface;

class CheckIfEmailAlreadyUsed {

    public function __construct(private UserRepositoryInterface $userRepository)
    {}

    public function check(string $email)
    {
        $user = $this->userRepository->findByEmail($email);

        return $user ? true : false;

    }

}

?>