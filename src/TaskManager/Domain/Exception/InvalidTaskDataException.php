<?php

namespace App\TaskManager\Domain\Exception;

use Exception;

class InvalidTaskDataException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid task data');
    }
}
