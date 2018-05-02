<?php

namespace Tests\MeetupOrganizing\Integration\Infrastructure\Persistence\InMemory;

use Assert\Assertion;
use MeetupOrganizing\Domain\Model\MeetupId;
use MeetupOrganizing\Domain\Repository\MeetupRepositoryInterface;
use MeetupOrganizing\Infrastructure\Persistence\InMemory\MeetupRepositoryInMemory;
use PHPUnit\Framework\TestCase;
use Tests\MeetupOrganizing\Unit\Domain\Model\Description\Util\MeetupFactory;

class MeetupRepositoryInMemoryTest extends TestCase
{
    /** @var MeetupRepositoryInterface */
    private $repository;

    protected function setUp()
    {
        $this->repository = new MeetupRepositoryInMemory();
    }

    /**
     * @test
     */
    public function it_persists_and_retrieves_meetups()
    {
        $originalMeetup = MeetupFactory::someMeetup();
        $this->repository->add($originalMeetup);

        $this->assertInstanceOf(MeetupId::class, $originalMeetup->id());
        Assertion::uuid($originalMeetup->id());

        $restoredMeetup = $this->repository->byId($originalMeetup->id());

        $this->assertEquals($originalMeetup, $restoredMeetup);
    }

    /**
     * @test
     */
    public function its_initial_state_is_valid()
    {
        $this->assertSame(
            [],
            $this->repository->upcomingMeetups(new \DateTimeImmutable())
        );
    }

    /**
     * @test
     */
    public function it_lists_upcoming_meetups()
    {
        $now = new \DateTimeImmutable();
        $pastMeetup = MeetupFactory::pastMeetup();
        $this->repository->add($pastMeetup);
        $upcomingMeetup = MeetupFactory::upcomingMeetup();
        $this->repository->add($upcomingMeetup);

        $this->assertEquals(
            [
                $upcomingMeetup
            ],
            $this->repository->upcomingMeetups($now)
        );
    }

    /**
     * @test
     */
    public function it_lists_past_meetups()
    {
        $now = new \DateTimeImmutable();
        $pastMeetup = MeetupFactory::pastMeetup();
        $this->repository->add($pastMeetup);
        $upcomingMeetup = MeetupFactory::upcomingMeetup();
        $this->repository->add($upcomingMeetup);

        $this->assertEquals(
            [
                $pastMeetup
            ],
            $this->repository->pastMeetups($now)
        );
    }

    /**
     * @test
     */
    public function it_can_delete_all_meetups()
    {
        $meetup = MeetupFactory::upcomingMeetup();
        $this->repository->add($meetup);
        $this->assertEquals([$meetup], $this->repository->allMeetups());

        $this->repository->deleteAll();

        $this->assertEquals([], $this->repository->upcomingMeetups(new \DateTimeImmutable()));
        $this->assertEquals([], $this->repository->pastMeetups(new \DateTimeImmutable()));
    }
}
