<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Domain\Contact;

use App\ContactManager\Domain\Contact\Contact;
use App\ContactManager\Domain\Contact\ContactId;
use App\ContactManager\Domain\Contact\ContactName;
use PHPUnit\Framework\TestCase;

final class ContactTest extends TestCase
{
    public function testShouldCreateContact(): void
    {
        $contactId = new ContactId('FM');
        $contactName = new ContactName('Fox Mulder');

        $contact = Contact::create($contactId, $contactName);
        $contactState = $contact->getState();

        self::assertSame($contactId, $contact->id());
        self::assertSame($contactName, $contact->name());
        self::assertSame('FM', $contactState->id);
        self::assertSame('Fox Mulder', $contactState->name);
    }
}
