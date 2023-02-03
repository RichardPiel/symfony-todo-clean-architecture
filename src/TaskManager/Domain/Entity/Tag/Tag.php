<?php

namespace App\TaskManager\Domain\Entity\Tag;

class Tag
{

    protected string $uuid;
    protected string $name;
    protected array $tasks;

    public function __construct(TagId $uuid, string $name)
    {
        $this->uuid = $uuid->getValue();
        $this->name = $name;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }
    
    public function setTasks(array $tasks): void
    {
        $this->tasks = $tasks;
    }

}

?>