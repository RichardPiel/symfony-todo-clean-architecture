<?php 

namespace App\TaskManager\Domain\Exception;

class EmailAlreadyExistException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Email already exists!');
    }
}

?>