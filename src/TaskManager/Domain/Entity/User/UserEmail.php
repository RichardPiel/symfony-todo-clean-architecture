<?php

namespace App\TaskManager\Domain\Entity\User;

use App\TaskManager\Domain\Exception\InvalidEmailFormatException;

class UserEmail
{
    private function __construct(public string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailFormatException();
        }
    }

    /**
     * @param string $email
     * @return self
     */
    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
