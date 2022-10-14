<?php

namespace App\ContactManager\Application\AddContact;

interface AddContactPresenter
{
    public function present(AddContactResponse $response): void;
}
