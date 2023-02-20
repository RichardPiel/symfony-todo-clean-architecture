<?php 

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Event\DomainEvent;

class AggregateRoot
{

    /**
     * @var DomainEvent[]
     */
    private array $events = [];

    public function registerEvent(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return DomainEvent[]
     */
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

}


?>