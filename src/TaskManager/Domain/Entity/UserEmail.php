<?php

namespace App\TaskManager\Domain\Entity;

class UserEmail
{

    private function __construct(public string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email format!');
        }
    }

    public static function fromString(string $email)
    {
        return new self($email);
    }

    public function __toString(): string
    {
        return $this->email;
    }

}

?>