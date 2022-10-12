<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Application\GetAllContacts;

use App\ContactManager\Application\GetAllContacts\GetAllContactsHandler;
use App\ContactManager\Application\GetAllContacts\GetAllContactsPresenter;
use App\ContactManager\Application\GetAllContacts\GetAllContactsResponse;
use App\ContactManager\Domain\Contact\Contact;
use App\ContactManager\Domain\Contact\ContactId;
use App\ContactManager\Domain\Contact\ContactName;
use App\Tests\ContactManager\Doubles\ContactGatewayInMemory;
use PHPUnit\Framework\TestCase;

final class GetAllContactsHandlerTest extends TestCase implements GetAllContactsPresenter
{
    private ContactGatewayInMemory $contactGateway;
    private GetAllContactsHandler $handler;
    private GetAllContactsResponse $response;

    public function testShouldRetrieveAllContacts(): void
    {
        $this->contactGateway->addContact(Contact::create(new ContactId('FM'), new ContactName('Fox Mulder')));
        $this->contactGateway->addContact(Contact::create(new ContactId('DS'), new ContactName('Dana Scully')));

        $this->handler->handle($this);

        self::assertCount(2, $this->response->contacts);
        self::assertSame('FM', $this->response->contacts[0]['id']);
        self::assertSame('Fox Mulder', $this->response->contacts[0]['name']);
        self::assertSame('DS', $this->response->contacts[1]['id']);
        self::assertSame('Dana Scully', $this->response->contacts[1]['name']);
    }

    public function present(GetAllContactsResponse $response): void
    {
        $this->response = $response;
    }

    protected function setUp(): void
    {
        $this->contactGateway = new ContactGatewayInMemory();
        $this->handler = new GetAllContactsHandler($this->contactGateway);
    }
}
