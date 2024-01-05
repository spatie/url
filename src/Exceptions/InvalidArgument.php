<?php

namespace Spatie\Url\Exceptions;

use InvalidArgumentException;

class InvalidArgument extends InvalidArgumentException
{
    public static function invalidScheme(string $scheme, array $allowedSchemes): static
    {
        $schemes = implode(', ', array_map(fn ($scheme) => "`{$scheme}`", $allowedSchemes));

        return new static("The scheme `{$scheme}` isn't valid. It should be either {$schemes}.");
    }

    public static function invalidUrl(string $url): static
    {
        return new static("The string `{$url}` is no valid url.");
    }

    public static function segmentZeroDoesNotExist(): static
    {
        return new static("Segment 0 doesn't exist. Segments can be retrieved by using 1-based index or a negative index.");
    }
}
