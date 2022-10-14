<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\ContactAdd;

final class ContactAddViewModelHTML
{
    /** @var array<array{type: string, message: string}> */
    public array $flashes = [];
    public ?string $redirectTo = null;
}
