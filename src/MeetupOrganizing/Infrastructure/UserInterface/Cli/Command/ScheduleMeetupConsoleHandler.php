<?php
declare(strict_types=1);

namespace MeetupOrganizing\Infrastructure\UserInterface\Cli\Command;

use MeetupOrganizing\Application\ScheduleMeetup;
use MeetupOrganizing\Application\ScheduleMeetupCommandHandler;
use MeetupOrganizing\Domain\Model\Description;
use MeetupOrganizing\Domain\Model\Meetup;
use MeetupOrganizing\Domain\Model\Name;
use MeetupOrganizing\Domain\Model\ScheduledDate;
use MeetupOrganizing\Infrastructure\Persistence\Filesystem\MeetupRepositoryFilesystem;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\IO\IO;

final class ScheduleMeetupConsoleHandler
{
    /**
     * @var ScheduleMeetupCommandHandler
     */
    private $scheduleMeetup;

    public function __construct(ScheduleMeetupCommandHandler $scheduleMeetup)
    {
        $this->scheduleMeetup = $scheduleMeetup;
    }

    public function handle(Args $args, IO $io): int
    {
        $scheduleMeetupCommand = new ScheduleMeetup(
            $args->getArgument('name'),
            $args->getArgument('description'),
            $args->getArgument('scheduledFor')
        );

        $this->scheduleMeetup->handle(
            $scheduleMeetupCommand
        );

        $io->writeLine('<success>Scheduled the meetup successfully</success>');

        return 0;
    }
}
