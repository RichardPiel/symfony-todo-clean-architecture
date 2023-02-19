<?php

namespace App\TaskManager\Domain\UseCase\Register;

use App\TaskManager\Domain\Validator\Validator;

class RegisterUserValidation extends Validator
{
    public function __construct(RegisterUserRequest $request)
    {
        parent::__construct($request);
        $this->add('email', 'NotEmpty', ['message' => 'Email is required'])
            ->add('email', 'IsEmail', ['message' => 'Email is not valid'])
            ->add('password', 'NotEmpty', ['message' => 'Password is required'])
            ->add('confirm_password', 'NotEmpty', ['message' => 'Confirm password is required'])
            ->add('password', 'NotEqual', [
                'message' => 'Confirm password is not equal to password',
                'rule' => function ($value, $request) {
                    return
                        isset($request->confirmPassword) &&
                        $value === $request->confirmPassword;
                }
            ])
            ->add('password', 'PasswordDifficulty', [
                'message' => 'Complexité du mot de passe insuffisante.',
                'rule' => function ($value, $context) {
                    return !(strlen($value) < 8 || !preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[\x00-\x7F]*/', $value));
                }
            ])
            ->validate();
    }

}

?>