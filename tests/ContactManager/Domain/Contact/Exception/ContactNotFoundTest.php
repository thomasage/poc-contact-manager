<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Domain\Contact\Exception;

use App\ContactManager\Domain\Contact\Exception\ContactNotFound;
use PHPUnit\Framework\TestCase;

final class ContactNotFoundTest extends TestCase
{
    public function testShouldHaveNotEmptyKey(): void
    {
        self::assertNotEmpty(ContactNotFound::key());
    }
}
