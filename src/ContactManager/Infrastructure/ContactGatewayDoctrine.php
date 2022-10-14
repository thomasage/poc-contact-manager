<?php

declare(strict_types=1);

namespace App\ContactManager\Infrastructure;

use App\ContactManager\Domain\Contact\Contact;
use App\ContactManager\Domain\Contact\ContactGateway;
use App\ContactManager\Domain\Contact\ContactId;
use App\ContactManager\Domain\Contact\ContactName;
use App\ContactManager\Domain\Contact\ContactState;
use App\ContactManager\Domain\Contact\Exception\ContactNotFound;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Result;
use Generator;
use RuntimeException;
use Symfony\Component\Uid\Uuid;

final class ContactGatewayDoctrine implements ContactGateway
{
    private const TABLE_NAME = 'contact';

    public function __construct(private readonly Connection $connection)
    {
    }

    /**
     * @throws Exception
     */
    public function addContact(Contact $contact): void
    {
        $this->connection->insert(self::TABLE_NAME, $this->transform($contact));
    }

    /**
     * @return array{uuid: string, name: string, registered_at: int}
     */
    private function transform(Contact $contact): array
    {
        $state = $contact->getState();

        return [
            'uuid' => Uuid::fromString($state->id)->toBinary(),
            'name' => $state->name,
            'registered_at' => $state->registeredAt,
        ];
    }

    public function deleteContact(Contact $contact): void
    {
        // TODO: Implement deleteContact() method.
        throw new RuntimeException('TODO');
    }

    /**
     * @return Generator<Contact>
     *
     * @throws Exception
     */
    public function getAllContacts(): Generator
    {
        $result = $this->connection->executeQuery('SELECT * FROM `'.self::TABLE_NAME.'` ORDER BY name');
        while ($contact = $this->fetch($result)) {
            yield $contact;
        }
        $result->free();
    }

    /**
     * @throws Exception
     */
    private function fetch(Result $result): ?Contact
    {
        $row = $result->fetchAssociative();
        if (false === $row) {
            return null;
        }
        /** @var array{uuid: string, name: string, registered_at: int} $row */
        $state = new ContactState();
        $state->id = (string) Uuid::fromBinary($row['uuid']);
        $state->name = $row['name'];
        $state->registeredAt = $row['registered_at'];

        return Contact::fromState($state);
    }

    public function getContactById(ContactId $id): Contact
    {
        // TODO: Implement getContactById() method.
        throw new RuntimeException('TODO');
    }

    /**
     * @throws ContactNotFound
     * @throws Exception
     */
    public function getContactByName(ContactName $name): Contact
    {
        $result = $this->connection->executeQuery('SELECT * FROM `'.self::TABLE_NAME.'` WHERE name = :name LIMIT 1', ['name' => (string) $name]);
        $contact = $this->fetch($result);
        $result->free();
        if (!$contact) {
            throw new ContactNotFound();
        }

        return $contact;
    }

    public function updateContact(Contact $contact): void
    {
        // TODO: Implement updateContact() method.
        throw new RuntimeException('TODO');
    }
}
