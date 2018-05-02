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

    /**
     * @var string|null
     */
    private $id;

    public function __construct(string $name, string $description, string $scheduledFor, string $id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->scheduledFor = $scheduledFor;
        $this->id = $id;
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

    public function getId(): ?string
    {
        return $this->id;
    }
}