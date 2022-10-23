<?php

declare(strict_types=1);

namespace App\ContactManager\UserInterface\ContactAdd;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class ContactAddFormData
{
    #[NotBlank]
    #[Length(min: 1, max: 255)]
    public string $name;
}
