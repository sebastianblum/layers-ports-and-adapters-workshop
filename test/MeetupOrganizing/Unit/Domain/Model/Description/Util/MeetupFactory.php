<?php
declare(strict_types = 1);

namespace Tests\MeetupOrganizing\Unit\Domain\Model\Description\Util;

use MeetupOrganizing\Domain\Model\Description;
use MeetupOrganizing\Domain\Model\Meetup;
use MeetupOrganizing\Domain\Model\MeetupId;
use MeetupOrganizing\Domain\Model\Name;
use MeetupOrganizing\Domain\Model\ScheduledDate;

class MeetupFactory
{
    public static function pastMeetup(): Meetup
    {
        return Meetup::schedule(
            Name::fromString('Name'),
            Description::fromString('Description'),
            ScheduledDate::fromPhpDateString('-5 days'),
            MeetupId::fromString('1e8349fb-06d0-4625-b44f-a7979786c6f5')
        );
    }

    public static function upcomingMeetup(): Meetup
    {
        return Meetup::schedule(
            Name::fromString('Name'),
            Description::fromString('Description'),
            ScheduledDate::fromPhpDateString('+5 days'),
            MeetupId::fromString('1e8349fb-06d0-4625-b44f-a7979786c6f4')
        );
    }

    public static function someMeetup(): Meetup
    {
        return self::upcomingMeetup();
    }
}
