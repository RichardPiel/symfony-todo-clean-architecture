<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

use DateTime;

abstract class DomainEvent
{
    public readonly string $occurredOn;

    public function __construct(
        public readonly string $aggregateId,
        string $occurredOn = null
    )
    {
        $this->occurredOn = $occurredOn ?: (new DateTime())->format('Y-m-d H:i:s');
    }

    abstract public static function getEventName(): string;

    // abstract public static function fromPrimitives(string $aggregateId, array $body, string $occurredOn): static;

    // abstract public function toPrimitives(): array;
}