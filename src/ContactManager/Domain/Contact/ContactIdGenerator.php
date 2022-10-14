<?php

declare(strict_types=1);

namespace App\ContactManager\Domain\Contact;

interface ContactIdGenerator
{
    public function generate(): ContactId;
}
