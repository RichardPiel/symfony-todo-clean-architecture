<?php 

namespace App\TaskManager\Domain\Repository;

use App\TaskManager\Domain\Entity\User;
use App\TaskManager\Domain\Entity\UserId;

interface UserRepositoryInterface {

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void;

    /**
     * @param UserId $id
     * @return User|null
     */
    public function findById(string $id): ?User;

    public function findAll(): array;

    public function findByEmail(string $email): ?User;
    

}


?>