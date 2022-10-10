<?php

namespace App\ContactManager\Domain\Contact;

use App\ContactManager\Domain\Contact\Exception\ContactNotFound;
use Generator;

interface ContactGateway
{
    public function addContact(Contact $contact): void;

    /**
     * @throws ContactNotFound
     */
    public function deleteContact(Contact $contact): void;

    /**
     * @return Generator<Contact>
     */
    public function getAllContacts(): Generator;

    /**
     * @throws ContactNotFound
     */
    public function getContactById(ContactId $id): Contact;

    /**
     * @throws ContactNotFound
     */
    public function updateContact(Contact $contact): void;
}
