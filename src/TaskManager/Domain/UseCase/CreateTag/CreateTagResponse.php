<?php

namespace App\TaskManager\Domain\UseCase\CreateTag;

use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\UseCase\ResponseTrait;

class CreateTagResponse
{

    use ResponseTrait;
    
    protected ?string $tagUuid = null;
 
    public function getTagUuid(): ?string
    {
        return $this->tagUuid;
    }

    public function setTagUuid(string $tagUuid): void
    {
        $this->tagUuid = $tagUuid;
    }
}

?>