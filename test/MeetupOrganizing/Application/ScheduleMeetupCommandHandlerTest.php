<?php

namespace Tests\MeetupOrganizing\Application;

use MeetupOrganizing\Application\ScheduleMeetup;
use MeetupOrganizing\Application\ScheduleMeetupCommandHandler;
use MeetupOrganizing\Domain\Repository\MeetupRepositoryInterface;
use PHPUnit\Framework\TestCase;

class ScheduleMeetupCommandHandlerTest extends TestCase
{
    public function testConstruct()
    {
        $repository = $this->createMock(MeetupRepositoryInterface::class);

        $scheduleMeetup = new ScheduleMeetupCommandHandler($repository);
    }

    public function testScheduleMeetup()
    {
        $repository = $this->createMock(MeetupRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('add');

        $scheduleMeetup = new ScheduleMeetupCommandHandler($repository);
        $scheduleMeetupCommand = new ScheduleMeetup('my-name', 'my-description', 'tomorrow');

        $scheduleMeetup->handle($scheduleMeetupCommand);
    }
}
