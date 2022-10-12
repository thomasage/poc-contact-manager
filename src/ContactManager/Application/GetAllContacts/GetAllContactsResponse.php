<?php

declare(strict_types=1);

namespace App\ContactManager\Application\GetAllContacts;

final class GetAllContactsResponse
{
    /** @var array<array{id: string, name: string, registered_at: int}> */
    public array $contacts = [];
}
