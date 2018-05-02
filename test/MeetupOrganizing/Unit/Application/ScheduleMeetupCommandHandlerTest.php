<?php

namespace Tests\MeetupOrganizing\Unit\Application;

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
        $this->assertAttributeSame($repository, 'repository', $scheduleMeetup);
    }

    public function testScheduleMeetup()
    {
        $repository = $this->createMock(MeetupRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('add');

        $scheduleMeetup = new ScheduleMeetupCommandHandler($repository);
        $scheduleMeetupCommand = new ScheduleMeetup('my-name', 'my-description', 'tomorrow', '1e8349fb-06d0-4625-b44f-a7979786c6f6');

        $scheduleMeetup->handle($scheduleMeetupCommand);
    }
}
