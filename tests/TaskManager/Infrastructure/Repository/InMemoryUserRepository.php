<?php 

namespace App\Tests\TaskManager\Infrastructure\Repository;
use App\TaskManager\Domain\Entity\User;
use App\TaskManager\Domain\Entity\UserId;
use App\TaskManager\Domain\Repository\UserRepositoryInterface;

class InMemoryUserRepository implements UserRepositoryInterface
{
    private $users = [];

    public function save(User $user): void
    {
        $this->users[(string) $user->getUuid()] = $user;
    }

    public function findById(string $id): ?User
    {
        return $this->users[$id] ?? null;
    }

    public function findAll(): array
    {
        return $this->users;
    }

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

?>