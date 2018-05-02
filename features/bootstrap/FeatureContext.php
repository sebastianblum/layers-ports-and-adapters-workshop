<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use MeetupOrganizing\Infrastructure\Persistence\Filesystem\MeetupRepositoryFilesystem;

/**
 * Defines application features from the specific context.
 */
final class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @BeforeFeature
     */
    public static function purgeDatabase(): void
    {
        $container = require __DIR__ . '/../../app/container.php';

        /** @var MeetupRepositoryFilesystem $meetupRepository */
        $meetupRepository = $container[MeetupRepositoryFilesystem::class];
        $meetupRepository->deleteAll();
    }
}
