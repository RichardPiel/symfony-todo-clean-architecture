<?php

namespace App\TaskManager\Domain\UseCase\CreateTask;

use App\TaskManager\Domain\Validator\Validator;

class CreateTaskValidation extends Validator
{
    public function __construct(CreateTaskRequest $request)
    {
        parent::__construct($request);
        $this->add('name', 'NotEmpty', ['message' => 'Task name is required'])
            ->add('user', 'NotEmpty', ['message' => 'Task user is required'])
            ->validate();
    }

}

?>