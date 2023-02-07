<?php

namespace App\TaskManager\Domain\Entity\Task;

use DateTimeImmutable;
use DateTimeInterface;
use App\TaskManager\Domain\Entity\Tag\Tag;
use App\TaskManager\Domain\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use App\TaskManager\Domain\Exception\TaskAlreadyDoneException;

class Task implements \JsonSerializable
{
    protected string $uuid;
    protected ?string $content;
    protected ?DateTimeInterface $doneAt = null;
    readonly DateTimeImmutable $createdAt;
    readonly User $user;
    protected $tags;
    protected Task $parentTask;
    protected $childTasks;

    /**
     * @param TaskId $uuid
     * @param string $name
     */
    public function __construct(
        TaskId $uuid,
        protected string $name,
    )
    {
        $this->uuid = $uuid->getValue();
        $this->createdAt = new DateTimeImmutable();
        $this->tags = new ArrayCollection();
        $this->childTasks = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDoneAt(): ?DateTimeInterface
    {
        return $this->doneAt;
    }

    /**
     * @param DateTimeInterface $doneAt
     * @return self
     */
    public function setDoneAt(DateTimeInterface $doneAt): self
    {

        if ($this->getDoneAt() !== null) {
            throw new TaskAlreadyDoneException();
        }

        $this->doneAt = $doneAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return self
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;

    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function markAsDone(): Task
    {
        $this->setDoneAt(new DateTimeImmutable());

        return $this;
    }
    public function jsonSerialize(): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'content' => $this->content,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'doneAt' => $this->doneAt ? $this->doneAt->format('Y-m-d H:i:s') : null,
            'tags' => $this->tags,
        ];
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags): void
    {
        $this->tags = $tags;
    }

    public function setParent(Task $task)
    {
        $this->parentTask = $task;
    }

    public function getParentTask(): Task
    {
        return $this->parentTask;
    }

    public function getChildTasks() 
    {
        return $this->childTasks;
    }

    public function setChildTasks( $childTasks)
    {
        $this->childTasks = $childTasks;
    }

    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }
}