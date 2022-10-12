<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\Homepage;

final class HomepageViewModelHTML
{
    /** @var array<array{id: string, name: string, registered_at: string}> */
    public array $contacts = [];
}
