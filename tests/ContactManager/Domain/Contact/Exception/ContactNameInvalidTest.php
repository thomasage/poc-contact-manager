<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Domain\Contact\Exception;

use App\ContactManager\Domain\Contact\Exception\ContactNameInvalid;
use PHPUnit\Framework\TestCase;

final class ContactNameInvalidTest extends TestCase
{
    public function testShouldHaveNotEmptyKey(): void
    {
        self::assertNotEmpty(ContactNameInvalid::key());
    }
}
