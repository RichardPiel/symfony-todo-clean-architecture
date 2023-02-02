<?php 

namespace App\TaskManager\Domain\Exception;

class InvalidEmailFormatException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid email format!');
    }
}

?>