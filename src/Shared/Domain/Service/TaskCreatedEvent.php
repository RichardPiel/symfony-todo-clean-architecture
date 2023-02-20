<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\TaskManager\Domain\Entity\User\User;

final class TaskCreatedEvent extends DomainEvent
{
    public function __construct(
        string $id,
        public readonly string $name,
        public readonly User $user,
        string $occurredOn = null
    ) {
        parent::__construct($id, $occurredOn);
    }

    public static function getEventName(): string
    {
        return 'task.created';
    }

}
