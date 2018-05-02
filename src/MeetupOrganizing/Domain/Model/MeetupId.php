<?php
declare(strict_types = 1);

namespace MeetupOrganizing\Domain\Model;

use Common\DomainModel\AggregateId;
use Ramsey\Uuid\Uuid;

final class MeetupId
{
    use AggregateId;

    public static function create(): self
    {
        $uuid = Uuid::uuid4();

        return self::fromString($uuid->toString());
    }
}
