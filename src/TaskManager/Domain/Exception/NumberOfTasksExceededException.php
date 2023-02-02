<?php

namespace App\TaskManager\Domain\Exception;

use Exception;

class NumberOfTasksExceededException extends Exception
{
    public function __construct()
    {
        parent::__construct('Number of tasks exceeded!');
    }
}


?>