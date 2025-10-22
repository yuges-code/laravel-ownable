<?php

namespace Yuges\Ownable\Exceptions;

use Exception;
use TypeError;
use Yuges\Ownable\Models\Ownership;

class InvalidOwnership extends Exception
{
    public static function doesNotImplementOwnership(string $class): TypeError
    {
        $ownership = Ownership::class;

        return new TypeError("Ownership class `{$class}` must implement `{$ownership}`");
    }
}
