<?php 

namespace App\TaskManager\Domain\UseCase\Register;
use App\TaskManager\Domain\RequestInterface;

class RegisterUserRequest implements RequestInterface
{

  public function __construct(
    public string $email,
    public string $password,
    public string $confirmPassword
  )
  {}

  public function getEmail(): string
  {
    return $this->email;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function getConfirmPassword(): string
  {
    return $this->confirmPassword;
  }
  
}

?>