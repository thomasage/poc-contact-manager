<?php

declare(strict_types=1);

namespace App\ContactManager\Application\GetAllContacts;

use App\ContactManager\Domain\Contact\ContactGateway;

final class GetAllContactsHandler
{
    public function __construct(private readonly ContactGateway $contactGateway)
    {
    }

    public function handle(GetAllContactsPresenter $presenter): void
    {
        $response = new GetAllContactsResponse();
        foreach ($this->contactGateway->getAllContacts() as $contact) {
            $dto = new Contact();
            $dto->id = (string) $contact->id();
            $dto->name = (string) $contact->name();
            $response->contacts[] = $dto;
        }
        $presenter->present($response);
    }
}
