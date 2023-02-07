<?php

namespace App\TaskManager\Domain\UseCase\CreateTag;

use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\UseCase\ResponseTrait;

class CreateTagResponse
{

    use ResponseTrait;
    protected ?Tag $tag = null;
 
    public function getTag(): ?Tag
    {
        return $this->tag;
    }

    public function setTag(?Tag $tag): void
    {
        $this->tag = $tag;
    }
}

?>