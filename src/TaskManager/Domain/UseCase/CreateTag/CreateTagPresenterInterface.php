<?php

namespace App\TaskManager\Domain\UseCase\CreateTag;

use App\TaskManager\Domain\UseCase\CreateTag\CreateTagResponse;

interface CreateTagPresenterInterface
{
    public function present(CreateTagResponse $response): void;
}

?>