<?php

namespace App\TaskManager\Domain\Validator;

class Validation
{

    static public function notEmpty($value): bool
    {
        return !empty($value);
    }

    static public function isNumeric($value): bool
    {
        return !is_numeric($value);
    }

}

?>