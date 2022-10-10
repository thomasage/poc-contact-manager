<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Domain\Contact;

use App\ContactManager\Domain\Contact\ContactId;
use App\ContactManager\Domain\Contact\Exception\ContactIdInvalid;
use PHPUnit\Framework\TestCase;

final class ContactIdTest extends TestCase
{
    public function testShouldCreateContactId(): void
    {
        $id = 'test';

        $contactId = new ContactId($id);

        self::assertSame($id, (string) $contactId);
    }

    public function testShouldThrowExceptionIfEmpty(): void
    {
        $this->expectException(ContactIdInvalid::class);

        new ContactId('');
    }

    public function testShouldSameIdsBeEqual(): void
    {
        $id = 'test';
        $contactId0 = new ContactId($id);
        $contactId1 = new ContactId($id);

        self::assertTrue($contactId0->equalsTo($contactId1));
    }
}
