<?php

namespace MeetupOrganizing\Application;


use MeetupOrganizing\Domain\Model\Description;
use MeetupOrganizing\Domain\Model\Meetup;
use MeetupOrganizing\Domain\Model\MeetupId;
use MeetupOrganizing\Domain\Model\Name;
use MeetupOrganizing\Domain\Model\ScheduledDate;
use MeetupOrganizing\Domain\Repository\MeetupRepositoryInterface;

class ScheduleMeetupCommandHandler
{
    private $repository;

    public function __construct(MeetupRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(ScheduleMeetup $scheduleMeetupCommand): Meetup
    {
        $meetup = Meetup::schedule(
                Name::fromString($scheduleMeetupCommand->getName()),
                Description::fromString($scheduleMeetupCommand->getDescription()),
                ScheduledDate::fromPhpDateString($scheduleMeetupCommand->getScheduledFor()),
                MeetupId::create()
            );

        $this->repository->add($meetup);

        return $meetup;
    }
}