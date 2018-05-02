<?php

namespace MeetupOrganizing\Infrastructure\Persistence\InMemory;


use MeetupOrganizing\Domain\Model\Meetup;
use MeetupOrganizing\Domain\Model\MeetupId;
use MeetupOrganizing\Domain\Repository\MeetupRepositoryInterface;

class MeetupRepositoryInMemory implements MeetupRepositoryInterface
{
    private $meetups = [];

    public function add(Meetup $meetup): void
    {
        $this->meetups[(string) $meetup->id()] = $meetup;
    }

    public function byId(MeetupId $meetupId): Meetup
    {
        return $this->meetups[(string) $meetupId];
    }

    public function upcomingMeetups(\DateTimeImmutable $now): array
    {
        return array_values(array_filter($this->meetups, function (Meetup $meetup) use ($now) {
            return $meetup->isUpcoming($now);
        }));
    }

    public function pastMeetups(\DateTimeImmutable $now): array
    {
        return array_values(array_filter($this->meetups, function (Meetup $meetup) use ($now) {
            return !$meetup->isUpcoming($now);
        }));
    }

    public function allMeetups(): array
    {
        return array_values($this->meetups);
    }

    public function deleteAll(): void
    {
        $this->meetups = [];
    }

}