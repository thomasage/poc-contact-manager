<?php

declare(strict_types=1);

namespace App\ContactManager\Domain\Contact\Exception;

use App\Shared\DomainException;

final class ContactNameInvalid extends DomainException
{
    /**
     * @codeCoverageIgnore
     */
    public static function key(): string
    {
        return 'contact_name_invalid';
    }
}
