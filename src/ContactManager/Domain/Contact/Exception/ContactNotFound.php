<?php

declare(strict_types=1);

namespace App\ContactManager\Domain\Contact\Exception;

use App\Shared\DomainException;

final class ContactNotFound extends DomainException
{
    public static function key(): string
    {
        return 'contact_not_found';
    }
}
