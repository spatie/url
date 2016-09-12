<?php

namespace Spatie\Url\Exceptions;

class InvalidArgument extends \InvalidArgumentException
{
    public static function invalidScheme(string $url): self
    {
        return new static("The scheme `{$url}` isn't valid.");
    }
}
