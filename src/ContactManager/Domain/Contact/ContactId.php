<?php

declare(strict_types=1);

namespace App\ContactManager\Domain\Contact;

use App\ContactManager\Domain\Contact\Exception\ContactIdInvalid;
use Stringable;

final class ContactId implements Stringable
{
    public function __construct(private readonly string $id)
    {
        $this->assertIsValid();
    }

    private function assertIsValid(): void
    {
        if ('' === $this->id) {
            throw new ContactIdInvalid();
        }
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function equalsTo(self $id): bool
    {
        return $id->id === $this->id;
    }
}
