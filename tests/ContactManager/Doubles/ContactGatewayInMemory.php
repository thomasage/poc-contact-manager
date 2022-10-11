<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Doubles;

use App\ContactManager\Domain\Contact\Contact;
use App\ContactManager\Domain\Contact\ContactGateway;
use App\ContactManager\Domain\Contact\ContactId;
use App\ContactManager\Domain\Contact\Exception\ContactNotFound;
use Generator;

final class ContactGatewayInMemory implements ContactGateway
{
    /** @var Contact[] */
    private array $contacts = [];

    public function addContact(Contact $contact): void
    {
        $this->contacts[] = $contact;
    }

    public function deleteContact(Contact $contact): void
    {
        throw new \RuntimeException('TODO');
    }

    /**
     * @return Generator<Contact>
     */
    public function getAllContacts(): Generator
    {
        yield from $this->contacts;
    }

    /**
     * @throws ContactNotFound
     */
    public function getContactById(ContactId $id): Contact
    {
        foreach ($this->contacts as $contact) {
            if ($contact->id()->equalsTo($id)) {
                return $contact;
            }
        }
        throw new ContactNotFound();
    }

    public function updateContact(Contact $contact): void
    {
        throw new \RuntimeException('TODO');
    }
}
