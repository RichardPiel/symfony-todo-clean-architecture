<?php

namespace App\TaskManager\Domain\UseCase\MarkTaskAsDone;

use App\TaskManager\Domain\Validator\Validator;

class MarkTaskAsDoneValidation extends Validator
{
    public function __construct(MarkTaskAsDoneRequest $request)
    {
        parent::__construct($request);
        $this->add('uuid', 'NotEmpty', ['message' => 'Task uuid is required'])
            ->validate();
    }

}

?>