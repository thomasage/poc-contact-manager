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

    public static function fromState(ContactState $state): self
    {
        /** @var DateTimeImmutable $registeredAt */
        $registeredAt = DateTimeImmutable::createFromFormat('U', (string) $state->registeredAt);
        $contact = new self();
        $contact->id = new ContactId($state->id);
        $contact->name = new ContactName($state->name);
        $contact->registeredAt = $registeredAt;

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
        $state->registeredAt = (int) $this->registeredAt->format('U');

        return $state;
    }

    public function registeredAt(): DateTimeImmutable
    {
        return $this->registeredAt;
    }
}
