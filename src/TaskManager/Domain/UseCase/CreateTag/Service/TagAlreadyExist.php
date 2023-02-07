<?php 

namespace App\TaskManager\Domain\UseCase\CreateTag\Service;

use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Repository\TagRepositoryInterface;

class TagAlreadyExist
{
    public function __construct(
        protected TagRepositoryInterface $repository,
    )
    {}

    public function check(string $name, User $user): bool
    {
        $tag = $this->repository->findBy(['name' => $name, 'user' => $user]);
        return $tag ? true : false;
    }
}

?>