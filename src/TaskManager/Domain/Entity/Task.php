<?php

namespace App\TaskManager\Domain\Entity;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use JetBrains\PhpStorm\Immutable;
use App\TaskManager\Domain\Exception\TaskAlreadyDoneException;

class Task 
{
    protected DateTimeImmutable $createdAt;
    protected string $uuid;
    protected ?DateTimeInterface $doneAt = null;

    protected User $user;

    /**
     * @param string $name
     * @param string $content
     */
    public function __construct(
        TaskId $uuid,
        protected string $name,
        protected string $content
    )
    {
        $this->uuid = $uuid->getValue();
        $this->createdAt = DateTimeImmutable::createFromFormat('U.u', microtime(true));
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
  
  
}