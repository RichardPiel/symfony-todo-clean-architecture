<?php

namespace App\Shared\Domain\Service;
use App\TaskManager\Domain\Exception\InvalidPasswordRequirementsException;

class PasswordRequirements
{

    public function check(string $password, string $confirmPassword): void
    {
        if (strlen($password) < 8) {
            throw new InvalidPasswordRequirementsException('Password must be at least 8 characters long.');
        }

        if ( !preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[\x00-\x7F]*/', $password) ) {
            throw new InvalidPasswordRequirementsException('Password must contain at least one number, one lowercase and one uppercase letter.');
        }

        if ($password !== $confirmPassword) {
            throw new InvalidPasswordRequirementsException('Password and confirm password must be the same.');
        }

    }

}

?>