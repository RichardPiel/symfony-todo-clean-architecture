<?php

namespace App\TaskManager\Domain\Exception;


class TaskAlreadyDoneException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Task already done!');
    }
}