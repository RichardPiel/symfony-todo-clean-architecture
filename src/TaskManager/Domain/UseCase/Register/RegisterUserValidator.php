<?php 

namespace App\TaskManager\Domain\UseCase\Register;

use App\TaskManager\Domain\Validator\Validator;

class RegisterUserValidator extends Validator
{
   
    public function setValidation(): void
    {
        $this->add('name', 'NotEmpty');
        $this->add('description', 'NotEmpty');
        $this->add('email', 'NotEmpty');
    }

}

?>