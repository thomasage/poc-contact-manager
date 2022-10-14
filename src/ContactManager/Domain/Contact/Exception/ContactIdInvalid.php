<?php

declare(strict_types=1);

namespace App\ContactManager\Domain\Contact\Exception;

use App\Shared\DomainException;

final class ContactIdInvalid extends DomainException
{
    /**
     * @codeCoverageIgnore
     */
    public static function key(): string
    {
        return 'contact_id_invalid';
    }
}
