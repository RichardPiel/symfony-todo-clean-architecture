<?php 

namespace App\TaskManager\Domain\Exception;

class InvalidUuidException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid uuid format!');
    }
}

?>