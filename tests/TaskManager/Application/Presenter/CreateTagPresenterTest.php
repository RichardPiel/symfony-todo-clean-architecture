<?php

namespace App\Tests\TaskManager\Application\Presenter;

use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\Entity\Tag\TagId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Application\Presenter\CreateTagPresenter;
use App\TaskManager\Domain\UseCase\CreateTag\CreateTagResponse;
use App\TaskManager\Application\ViewModel\CreateTagJsonViewModel;

class CreateTagPresenterTest extends KernelTestCase
{

    private CreateTagJsonViewModel $viewModel;
    private CreateTagPresenter $presenter;

    public function setUp(): void
    {
        $this->viewModel = $this->createMock(CreateTagJsonViewModel::class);
        $this->presenter = new CreateTagPresenter();
    }

    public function testPresent()
    {
        $response = $this->createMock(CreateTagResponse::class);

        $response->expects($this->exactly(2))
            ->method('getErrors')
            ->willReturn(['error']);
        $tagUuid = TagId::fromString(Uuid::uuid4());
        $tag = new Tag(
            $tagUuid,
            'name'
        );

        $response->expects($this->exactly(2))
            ->method('getTagUuid')
            ->willReturn(
                $tagUuid->getValue()
            );

        $this->presenter->present($response);

        $this->assertEquals($this->presenter->viewModel()->errors, ['error']);
        $this->assertEquals($this->presenter->viewModel()->tagUuid, $tag->getUuid());

    }

}

?>