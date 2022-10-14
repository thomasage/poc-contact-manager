<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Domain\Contact;

use App\ContactManager\Domain\Contact\Contact;
use App\ContactManager\Domain\Contact\ContactId;
use App\ContactManager\Domain\Contact\ContactName;
use App\ContactManager\Domain\Contact\ContactService;
use App\ContactManager\Domain\Contact\Exception\ContactAlreadyExists;
use App\Tests\ContactManager\Doubles\ContactGatewayInMemory;
use PHPUnit\Framework\TestCase;

final class ContactServiceTest extends TestCase
{
    private ContactGatewayInMemory $contactGateway;
    private ContactService $contactService;

    public function testShouldAddContact(): void
    {
        $contactId = new ContactId('test');
        $contact = Contact::create($contactId, new ContactName('Fox Mulder'));

        $this->contactService->addContact($contact);
        $foundContact = $this->contactGateway->getContactById($contactId);

        self::assertTrue($contactId->equalsTo($foundContact->id()));
    }

    public function testShouldThrowExceptionIfDuplicates(): void
    {
        $contactId = new ContactId('test');
        $contact = Contact::create($contactId, new ContactName('Fox Mulder'));
        $this->contactGateway->addContact($contact);

        $this->expectException(ContactAlreadyExists::class);

        $this->contactService->addContact($contact);
    }

    protected function setUp(): void
    {
        $this->contactGateway = new ContactGatewayInMemory();
        $this->contactService = new ContactService($this->contactGateway);
    }
}
