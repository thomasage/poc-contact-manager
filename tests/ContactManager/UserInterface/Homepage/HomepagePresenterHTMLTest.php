<?php

declare(strict_types=1);

namespace App\Tests\ContactManager\UserInterface\Homepage;

use App\ContactManager\Application\GetAllContacts\GetAllContactsResponse;
use App\ContactManager\UserInterface\Homepage\HomepagePresenterHTML;
use PHPUnit\Framework\TestCase;

final class HomepagePresenterHTMLTest extends TestCase
{
    public function testShouldPresentResponse(): void
    {
        $presenter = new HomepagePresenterHTML();
        $response = new GetAllContactsResponse();
        $response->contacts[] = [
            'id' => 'FM',
            'name' => 'Fox Mulder',
            'registered_at' => 1586048523,
        ];

        $presenter->present($response);

        self::assertCount(1, $presenter->viewModel->contacts);
        self::assertSame('FM', $presenter->viewModel->contacts[0]['id']);
        self::assertSame('Fox Mulder', $presenter->viewModel->contacts[0]['name']);
        self::assertSame('Sun, 05 Apr 2020 01:02:03 +0000', $presenter->viewModel->contacts[0]['registered_at']);
    }
}
