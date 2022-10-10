<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Domain\Contact;

use App\ContactManager\Domain\Contact\ContactName;
use App\ContactManager\Domain\Contact\Exception\ContactNameInvalid;
use PHPUnit\Framework\TestCase;

final class ContactNameTest extends TestCase
{
    public function testShouldCreateContactName(): void
    {
        $name = 'Fox Mulder';

        $contactName = new ContactName($name);

        self::assertSame($name, (string) $contactName);
    }

    public function testShouldThrowExceptionIfEmpty(): void
    {
        $this->expectException(ContactNameInvalid::class);

        new ContactName('');
    }

    public function testShouldSameNamesBeEqual(): void
    {
        $name = 'Fox Mulder';
        $contactName0 = new ContactName($name);
        $contactName1 = new ContactName($name);

        self::assertTrue($contactName0->equalsTo($contactName1));
    }
}
