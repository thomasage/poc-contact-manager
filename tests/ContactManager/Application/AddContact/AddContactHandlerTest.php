<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\Application\AddContact;

use App\ContactManager\Application\AddContact\AddContactHandler;
use App\ContactManager\Application\AddContact\AddContactPresenter;
use App\ContactManager\Application\AddContact\AddContactRequest;
use App\ContactManager\Application\AddContact\AddContactResponse;
use App\ContactManager\Domain\Contact\Contact;
use App\ContactManager\Domain\Contact\ContactId;
use App\ContactManager\Domain\Contact\ContactName;
use App\ContactManager\Domain\Contact\ContactService;
use App\Tests\ContactManager\Doubles\ContactGatewayInMemory;
use App\Tests\ContactManager\Doubles\ContactIdGeneratorMD5;
use PHPUnit\Framework\TestCase;

final class AddContactHandlerTest extends TestCase implements AddContactPresenter
{
    private ContactIdGeneratorMD5 $contactIdGenerator;
    private ContactGatewayInMemory $contactGateway;
    private AddContactHandler $handler;
    private AddContactResponse $response;

    public function testShouldAddContact(): void
    {
        $request = new AddContactRequest();
        $request->name = 'Fox Mulder';

        $this->handler->handle($request, $this);

        self::assertNotNull($this->response->id);
        self::assertCount(0, $this->response->errors);
        /** @var string $responseId */
        $responseId = $this->response->id;
        $contact = $this->contactGateway->getContactById(new ContactId($responseId));
        self::assertSame($this->response->id, (string) $contact->id());
    }

    public function testShouldNotAddDuplicates(): void
    {
        $contactName = 'Fox Mulder';
        $this->contactGateway->addContact(
            Contact::create(
                $this->contactIdGenerator->generate(),
                new ContactName($contactName)
            )
        );
        $request = new AddContactRequest();
        $request->name = $contactName;

        $this->handler->handle($request, $this);

        self::assertNull($this->response->id);
        self::assertCount(1, $this->response->errors);
        self::assertSame('contact_already_exists', $this->response->errors[0]);
    }

    public function present(AddContactResponse $response): void
    {
        $this->response = $response;
    }

    protected function setUp(): void
    {
        $this->contactIdGenerator = new ContactIdGeneratorMD5();
        $this->contactGateway = new ContactGatewayInMemory();
        $contactService = new ContactService($this->contactGateway);
        $this->handler = new AddContactHandler($this->contactIdGenerator, $contactService);
    }
}
