<?php

namespace App\TaskManager\Domain\Entity\User;

class UserPassword
{
    protected const ALGO = PASSWORD_BCRYPT;

    private function __construct(protected string $password)
    {
        $this->password = password_hash($password, self::ALGO);
    }

    /**
     * @param string $password
     * @return string
     */
    public static function fromString(string $password): string
    {
        return new self($password);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->password;
    }
}
