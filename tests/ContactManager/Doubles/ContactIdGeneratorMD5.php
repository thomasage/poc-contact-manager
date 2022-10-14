<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Doubles;

use App\ContactManager\Domain\Contact\ContactId;
use App\ContactManager\Domain\Contact\ContactIdGenerator;

final class ContactIdGeneratorMD5 implements ContactIdGenerator
{
    public function generate(): ContactId
    {
        return new ContactId(md5(uniqid((string) mt_rand(), true)));
    }
}
