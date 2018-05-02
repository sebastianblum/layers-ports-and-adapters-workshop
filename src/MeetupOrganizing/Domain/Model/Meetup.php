<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model;

final class Meetup
{
    /**
     * @var MeetupId
     */
    private $id;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var Description
     */
    private $description;

    /**
     * @var ScheduledDate
     */
    private $scheduledFor;

    public static function schedule(Name $name, Description $description, ScheduledDate $scheduledFor, MeetupId $meetupId): Meetup
    {
        $meetup = new self();
        $meetup->id = $meetupId;
        $meetup->name = $name;
        $meetup->description = $description;
        $meetup->scheduledFor = $scheduledFor;

        return $meetup;
    }

    public function id(): MeetupId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function description(): Description
    {
        return $this->description;
    }

    public function scheduledFor(): ScheduledDate
    {
        return $this->scheduledFor;
    }

    public function isUpcoming(\DateTimeImmutable $now): bool
    {
        return $this->scheduledFor()->isInTheFuture($now);
    }
}
