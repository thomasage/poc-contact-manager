<?php

declare(strict_types=1);

namespace App\ContactManager\Domain\Contact;

final class ContactState
{
    public string $id;
    public string $name;
    public int $registeredAt;
}
