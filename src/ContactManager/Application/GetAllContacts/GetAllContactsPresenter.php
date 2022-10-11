<?php

namespace App\ContactManager\Application\GetAllContacts;

interface GetAllContactsPresenter
{
    public function present(GetAllContactsResponse $response): void;
}
