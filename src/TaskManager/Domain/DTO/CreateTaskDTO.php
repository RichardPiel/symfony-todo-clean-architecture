<?php

namespace App\TaskManager\Domain\DTO;

class CreateTaskDTO
{
    protected string $title;
    protected string $content;
    protected string $userId;

    public function __construct(string $title, string $content, string $userId)
    {
        $this->title = $title;
        $this->content = $content;
        $this->userId = $userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
