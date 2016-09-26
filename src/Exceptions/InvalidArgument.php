<?php

namespace Spatie\Url\Exceptions;

use InvalidArgumentException;

class InvalidArgument extends InvalidArgumentException
{
    public static function invalidScheme(string $url): self
    {
        return new static("The scheme `{$url}` isn't valid. It should be either `http` or `https`.");
    }

    public static function segmentZeroDoesNotExist()
    {
        return new static("Segment 0 doesn't exist. Segments can be retrieved by using 1-based index or a negative index.");
    }
}
