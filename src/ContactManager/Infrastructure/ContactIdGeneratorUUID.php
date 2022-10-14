<?php

declare(strict_types=1);

namespace App\ContactManager\Infrastructure;

use App\ContactManager\Domain\Contact\ContactId;
use App\ContactManager\Domain\Contact\ContactIdGenerator;
use Symfony\Component\Uid\Uuid;

final class ContactIdGeneratorUUID implements ContactIdGenerator
{
    public function generate(): ContactId
    {
        return new ContactId((string) Uuid::v4());
    }
}
