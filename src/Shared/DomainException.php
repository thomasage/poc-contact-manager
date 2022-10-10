<?php

declare(strict_types=1);

namespace App\Shared;

abstract class DomainException extends \DomainException
{
    abstract public static function key(): string;
}
