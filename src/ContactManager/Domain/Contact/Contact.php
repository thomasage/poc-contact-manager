<?php

declare(strict_types=1);

namespace App\ContactManager\Domain\Contact;

use DateTimeImmutable;

final class Contact
{
    private ContactId $id;
    private ContactName $name;
    private DateTimeImmutable $registeredAt;

    private function __construct()
    {
    }

    public static function create(ContactId $id, ContactName $name): self
    {
        $contact = new self();
        $contact->id = $id;
        $contact->name = $name;
        $contact->registeredAt = new DateTimeImmutable();

        return $contact;
    }

    public function id(): ContactId
    {
        return $this->id;
    }

    public function name(): ContactName
    {
        return $this->name;
    }

    public function getState(): ContactState
    {
        $state = new ContactState();
        $state->id = (string) $this->id;
        $state->name = (string) $this->name;
        $state->registeredAt = $this->registeredAt->format('c');

        return $state;
    }
}
