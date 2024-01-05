<?php

namespace Spatie\Url;

use Spatie\Url\Exceptions\InvalidArgument;

class SchemeValidator extends BaseValidator
{
    public const VALID_SCHEMES = ['http', 'https', 'mailto', 'tel'];

    private string|null $scheme;

    public function __construct(
        private array|null $allowedSchemes = null
    ) {
        $this->scheme = null;
        $this->allowedSchemes = $allowedSchemes ?? self::VALID_SCHEMES;
    }

    public function validate(): void
    {
        // '' aka "no scheme" must always be valid
        $alwaysAllowedSchemes = [''];

        if (! in_array($this->scheme, [...$this->allowedSchemes, ...$alwaysAllowedSchemes])) {
            throw InvalidArgument::invalidScheme($this->scheme, $this->allowedSchemes);
        }
    }

    public static function sanitizeScheme(string $scheme): string
    {
        // TODO: regex to allow correct format according to https://datatracker.ietf.org/doc/html/rfc3986#section-3.1
        return strtolower($scheme);
    }

    public function getScheme(): string|null
    {
        return $this->scheme;
    }

    public function setScheme(string $scheme): void
    {
        $this->scheme = $scheme;
    }

    public function getAllowedSchemes(): array|null
    {
        return $this->allowedSchemes;
    }

    public function setAllowedSchemes(array $allowedSchemes): void
    {
        $this->allowedSchemes = array_map(
            fn ($scheme) => static::sanitizeScheme($scheme),
            $allowedSchemes
        );
    }
}
