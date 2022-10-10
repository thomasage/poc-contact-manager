<?php

declare(strict_types=1);

namespace App\ContactManager\Domain\Contact;

use App\ContactManager\Domain\Contact\Exception\ContactNameInvalid;
use Stringable;

final class ContactName implements Stringable
{
    public function __construct(private readonly string $name)
    {
        $this->assertIsValid();
    }

    private function assertIsValid(): void
    {
        if ('' === $this->name) {
            throw new ContactNameInvalid();
        }
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function equalsTo(self $name): bool
    {
        return $name->name === $this->name;
    }
}
