<?php

declare(strict_types=1);

namespace App\Shared\Domain\Subscriber;
use App\Shared\Domain\Event\TaskCreatedEvent;
use App\Shared\Domain\Event\EventSubscriberInterface;

final class TaskCreatedSubscriber implements EventSubscriberInterface
{
    public function __construct(
    )
    {
        die('ok constructor');

    }

    public function subscribeTo(): array
    {
        return [TaskCreatedEvent::class];
    }

    public function __invoke(TaskCreatedEvent $event): void
    {
        die('ok');
    }
}