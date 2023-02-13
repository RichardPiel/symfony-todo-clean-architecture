<?php 

namespace App\TaskManager\Domain\UseCase\Register;

use App\TaskManager\Domain\UseCase\Register\RegisterUserResponse;

/**
 * Interface nécessaire pour gérer différents types de retour (HTML, JSON, XML, etc.)
 */
interface RegisterUserPresenterInterface
{
    public function present(RegisterUserResponse $response): void;

    public function setHttpCode(int $code): void;

    public function getHttpCode(): int;

}


?>