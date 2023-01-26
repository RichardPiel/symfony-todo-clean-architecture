<?php

namespace App\Tests\TaskManager\Infrastructure\Repository;

use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;

class InMemoryUserRepository implements UserRepositoryInterface
{
    /**
     * @var array<User>
     */
    private array $users = [];

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void
    {
        $this->users[(string) $user->getUuid()] = $user;
    }

    /**
     * @param string $id
     * @return User|null
     */
    public function findById(string $id): ?User
    {
        return $this->users[$id] ?? null;
    }

    /**
     * @return array<User>
     */
    public function findAll(): array
    {
        return $this->users;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }

        return null;
    }
}
