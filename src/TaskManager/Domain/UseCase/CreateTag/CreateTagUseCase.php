<?php

namespace App\TaskManager\Domain\UseCase\CreateTag;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\Entity\Tag\TagId;
use App\TaskManager\Domain\Repository\TagRepositoryInterface;
use App\TaskManager\Domain\Exception\TagAlreadyExistException;
use App\TaskManager\Domain\UseCase\CreateTag\CreateTagResponse;
use App\TaskManager\Domain\UseCase\CreateTag\Service\TagAlreadyExist;

class CreateTagUseCase
{

    public function __construct(
        protected TagRepositoryInterface $repository,
        protected TagAlreadyExist $tagAlreadyExist
    )
    {
    }

    public function execute(CreateTagRequest $request, CreateTagPresenterInterface $presenter)
    {
        $response = new CreateTagResponse();

        $validator = new CreateTagValidation($request);

        try {

            if (!$validator->isValid()) {
                $response->setErrors($validator->getErrors());
            } else {
                $tag = $this->createTag($request);
                $response->setTagUuid($tag->getUuid());
            }
            
        } catch (TagAlreadyExistException $th) {
            $response->setError('name', $th->getMessage());

        } catch (\Throwable $th) {
            throw $th;
        }

        $presenter->present($response);
    }

    private function createTag(CreateTagRequest $request): Tag
    {
        if ($this->tagAlreadyExist->check($request->getName(), $request->getUser())) {
            throw new TagAlreadyExistException();
        }

        $tag = new Tag(
            TagId::fromString(Uuid::uuid4()),
            $request->getName(),
        );

        $tag->setUser($request->getUser());

        $this->repository->save($tag);

        return $tag;

    }

}

?>