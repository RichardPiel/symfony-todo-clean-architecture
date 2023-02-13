<?php 

namespace App\TaskManager\Domain\Exception;

class InvalidPasswordRequirementsException extends \Exception
{

    public function __construct(?string $message = null)
    {
        parent::__construct($message);
    }

}

?>