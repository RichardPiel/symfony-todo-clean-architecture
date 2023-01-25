<?php

namespace App\TaskManager\Domain\Entity;

class UserPassword
{

    protected const ALGO = PASSWORD_BCRYPT;

    private function __construct(protected string $password)
    {
        $this->password = password_hash($password, self::ALGO);
    }


    public static function fromString(string $password)
    {
        return new self($password);
    }

    public function __toString()
    {
        return $this->password;
    }

}

?>