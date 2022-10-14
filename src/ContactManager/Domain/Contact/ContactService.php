<?php

declare(strict_types=1);

namespace App\ContactManager\Domain\Contact;

use App\ContactManager\Domain\Contact\Exception\ContactAlreadyExists;
use App\ContactManager\Domain\Contact\Exception\ContactNotFound;

final class ContactService
{
    public function __construct(private readonly ContactGateway $contactGateway)
    {
    }

    public function addContact(Contact $contact): void
    {
        try {
            $this->contactGateway->getContactByName($contact->name());
            throw new ContactAlreadyExists();
        } catch (ContactNotFound $exception) {
            $this->contactGateway->addContact($contact);
        }
    }
}
