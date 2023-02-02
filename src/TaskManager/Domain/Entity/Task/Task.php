<?php

namespace App\TaskManager\Domain\Entity\Task;

use DateTimeImmutable;
use DateTimeInterface;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Exception\TaskAlreadyDoneException;

class Task implements \JsonSerializable
{
    protected string $uuid;
    protected string $content;
    protected ?DateTimeInterface $doneAt = null;
    readonly DateTimeImmutable $createdAt;
    readonly User $user;
    readonly string $user_id;

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
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        $this->user_id = $user->getUuid();

        return $this;
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
            'name' => $this->name,
            'content' => $this->content,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'doneAt' => $this->doneAt ? $this->doneAt->format('Y-m-d H:i:s') : null,
        ];
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }
}