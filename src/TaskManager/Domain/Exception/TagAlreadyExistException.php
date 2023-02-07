<?php 

namespace App\TaskManager\Domain\Exception;

class TagAlreadyExistException extends \Exception
{
    public function __construct(string $message = 'Tag already exist', int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

?>