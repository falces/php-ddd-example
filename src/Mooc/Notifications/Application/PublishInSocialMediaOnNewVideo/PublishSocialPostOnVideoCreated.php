<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Notifications\Application\PublishInSocialMediaOnNewVideo;

use CodelyTv\Mooc\Videos\Domain\VideoCreatedDomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class PublishSocialPostOnVideoCreated implements DomainEventSubscriber
{
    public function __construct(private readonly PublishInSocialMediaOnNewVideo $creator)
    {
    }

    public static function subscribedTo(): array
    {
        return [VideoCreatedDomainEvent::class];
    }

    public function __invoke(VideoCreatedDomainEvent $event): void
    {
        $this->creator->create(
            $event->aggregateId(),
            $event->getCourseId(),
        );
    }
}
