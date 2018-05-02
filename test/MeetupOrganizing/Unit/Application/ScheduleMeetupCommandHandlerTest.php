<?php

namespace Tests\MeetupOrganizing\Unit\Application;

use MeetupOrganizing\Application\ScheduleMeetup;
use MeetupOrganizing\Application\ScheduleMeetupCommandHandler;
use MeetupOrganizing\Domain\Model\Meetup;
use MeetupOrganizing\Infrastructure\Persistence\InMemory\MeetupRepositoryInMemory;
use PHPUnit\Framework\TestCase;

class ScheduleMeetupCommandHandlerTest extends TestCase
{
    public function testConstruct()
    {
        $repository = new MeetupRepositoryInMemory();

        $scheduleMeetup = new ScheduleMeetupCommandHandler($repository);
        $this->assertAttributeSame($repository, 'repository', $scheduleMeetup);
    }

    public function testScheduleMeetup()
    {
        $repository = new MeetupRepositoryInMemory();

        $scheduleMeetup = new ScheduleMeetupCommandHandler($repository);
        $scheduleMeetupCommand = new ScheduleMeetup('my-name', 'my-description', 'tomorrow', '1e8349fb-06d0-4625-b44f-a7979786c6f6');

        $scheduleMeetup->handle($scheduleMeetupCommand);

        $this->assertCount(1, $repository->allMeetups());
        $meetup = $repository->allMeetups()[0];
        $this->assertInstanceOf(Meetup::class, $meetup);
    }
}
