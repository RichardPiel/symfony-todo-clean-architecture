<?php

namespace App\TaskManager\Domain\UseCase\CreateTag;

use App\TaskManager\Domain\Validator\Validator;

class CreateTagValidation extends Validator
{
    public function __construct(CreateTagRequest $request)
    {
        parent::__construct($request);
        $this->add('name', 'NotEmpty', ['message' => 'Tag name is required'])
            ->add('user', 'NotEmpty', ['message' => 'Tag user is required'])
            ->validate();
    }

}

?>