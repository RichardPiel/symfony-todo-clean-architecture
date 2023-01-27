<?php

namespace App\TaskManager\Infrastructure\Security;

use App\TaskManager\Domain\Entity\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class SecurityUser implements UserInterface, PasswordAuthenticatedUserInterface 
{

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function getRoles(): array
    {
        return $this->user->getRoles();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Returns the identifier for this user (e.g. username or email address).
     */
    public function getUserIdentifier(): string
    {
        return $this->user->getEmail();
    }

    public function getPassword(): ?string
    {
        return $this->user->getPassword();
    }

}

?>