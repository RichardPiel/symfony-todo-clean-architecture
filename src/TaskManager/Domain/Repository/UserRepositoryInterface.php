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

    public function findById(string $id): ?User;
}