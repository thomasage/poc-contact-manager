<?php

declare(strict_types=1);

namespace App\ContactManager\Application\AddContact;

final class AddContactResponse
{
    /** @var string[] */
    public array $errors = [];
    public ?string $id = null;
}
