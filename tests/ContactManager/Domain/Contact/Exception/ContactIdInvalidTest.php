<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Domain\Contact\Exception;

use App\ContactManager\Domain\Contact\Exception\ContactIdInvalid;
use PHPUnit\Framework\TestCase;

final class ContactIdInvalidTest extends TestCase
{
    public function testShouldHaveNotEmptyKey(): void
    {
        self::assertNotEmpty(ContactIdInvalid::key());
    }
}
