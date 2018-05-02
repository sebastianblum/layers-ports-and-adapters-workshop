<?php

namespace MeetupOrganizing\Application;


use MeetupOrganizing\Domain\Model\Description;
use MeetupOrganizing\Domain\Model\Meetup;
use MeetupOrganizing\Domain\Model\Name;
use MeetupOrganizing\Domain\Model\ScheduledDate;

class ScheduleMeetup
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $scheduledFor;

    public function __construct(string $name, string $description, string $scheduledFor)
    {
        $this->name = $name;
        $this->description = $description;
        $this->scheduledFor = $scheduledFor;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getScheduledFor(): string
    {
        return $this->scheduledFor;
    }
}