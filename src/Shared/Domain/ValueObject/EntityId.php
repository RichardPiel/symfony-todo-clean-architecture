<?php

namespace App\Shared\Domain\ValueObject;

use Ramsey\Uuid\UuidInterface;
use App\TaskManager\Domain\Exception\InvalidUuidException;

abstract class EntityId
{
    protected string $uuid;

    private function __construct(UuidInterface $uuid)
    {
        if (!preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i', $uuid->toString())) {
            throw new InvalidUuidException();
        }

        $this->uuid = $uuid->toString();
    }

    public static function fromString(UuidInterface $uuid): self
    {
        return new static($uuid);
    }

    public function getValue(): string
    {
        return $this->uuid;
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}
