<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Doubles;

use App\ContactManager\Domain\Contact\Contact;
use App\ContactManager\Domain\Contact\ContactGateway;
use App\ContactManager\Domain\Contact\ContactId;
use App\ContactManager\Domain\Contact\ContactState;
use App\ContactManager\Domain\Contact\Exception\ContactNotFound;
use Generator;
use RuntimeException;

final class ContactGatewayInMemory implements ContactGateway
{
    /** @var ContactState[] */
    private array $contacts = [];

    public function addContact(Contact $contact): void
    {
        $this->contacts[] = $contact->getState();
    }

    public function deleteContact(Contact $contact): void
    {
        throw new RuntimeException('TODO');
    }

    /**
     * @return Generator<Contact>
     */
    public function getAllContacts(): Generator
    {
        yield from array_map(static fn (ContactState $state): Contact => Contact::fromState($state), $this->contacts);
    }

    /**
     * @throws ContactNotFound
     */
    public function getContactById(ContactId $id): Contact
    {
        foreach ($this->contacts as $state) {
            if ($id->equalsTo(new ContactId($state->id))) {
                return Contact::fromState($state);
            }
        }
        throw new ContactNotFound();
    }

    public function updateContact(Contact $contact): void
    {
        throw new RuntimeException('TODO');
    }
}
