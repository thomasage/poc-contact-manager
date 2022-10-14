<?php

declare(strict_types=1);

namespace App\ContactManager\Application\AddContact;

use App\ContactManager\Domain\Contact\Contact;
use App\ContactManager\Domain\Contact\ContactIdGenerator;
use App\ContactManager\Domain\Contact\ContactName;
use App\ContactManager\Domain\Contact\ContactService;
use App\ContactManager\Domain\Contact\Exception\ContactAlreadyExists;

final class AddContactHandler
{
    public function __construct(
        private readonly ContactIdGenerator $contactIdGenerator,
        private readonly ContactService $contactService,
    ) {
    }

    public function handle(AddContactRequest $request, AddContactPresenter $presenter): void
    {
        $contactId = $this->contactIdGenerator->generate();
        $contact = Contact::create($contactId, new ContactName($request->name));
        $response = new AddContactResponse();
        try {
            $this->contactService->addContact($contact);
            $response->id = (string) $contactId;
        } catch (ContactAlreadyExists $exception) {
            $response->errors[] = $exception::key();
        }
        $presenter->present($response);
    }
}
