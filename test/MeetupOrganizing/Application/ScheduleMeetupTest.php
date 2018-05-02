<?php

namespace Tests\MeetupOrganizing\Application;

use MeetupOrganizing\Application\ScheduleMeetup;
use PHPUnit\Framework\TestCase;

class ScheduleMeetupTest extends TestCase
{
    public function testScheduleMeetupCommand()
    {
        $scheduleMeetupCommand = new ScheduleMeetup('my-name', 'my-description', 'tomorrow');

        $this->assertSame('my-name', $scheduleMeetupCommand->getName());
        $this->assertSame('my-description', $scheduleMeetupCommand->getDescription());
        $this->assertSame('tomorrow', $scheduleMeetupCommand->getScheduledFor());
    }
}
