<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\Homepage;

use App\ContactManager\Application\GetAllContacts\GetAllContactsPresenter;
use App\ContactManager\Application\GetAllContacts\GetAllContactsResponse;
use DateTimeImmutable;

final class HomepagePresenterHTML implements GetAllContactsPresenter
{
    public readonly HomepageViewModelHTML $viewModel;

    public function __construct()
    {
        $this->viewModel = new HomepageViewModelHTML();
    }

    public function present(GetAllContactsResponse $response): void
    {
        $this->viewModel->contacts = array_map(static function (array $contact): array {
            /** @var DateTimeImmutable $registeredAt */
            $registeredAt = DateTimeImmutable::createFromFormat('U', (string) $contact['registered_at']);

            return [
                'id' => $contact['id'],
                'name' => $contact['name'],
                'registered_at' => $registeredAt->format('r'),
            ];
        }, $response->contacts);
    }
}
