<?php

namespace App\TaskManager\Domain\Repository;

use App\TaskManager\Domain\Entity\User\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void;

    /**
     * @return array<User>
     */
    public function findAll(): array;

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * @param string $id
     * @return User|null
     */
    public function findById(string $id): ?User;
}