<?php

namespace App\TaskManager\Application\ViewModel;

use App\TaskManager\Domain\Entity\Tag\Tag;

class CreateTagJsonViewModel
{

    public function __construct(
        public ?array $errors = null,
        public ?Tag $tag = null,
    )
    {
    }

}


?>