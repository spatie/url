<?php

namespace Spatie\Url;

use Spatie\Macroable\Macroable;
use Stringable;

class Scheme implements Stringable
{
    use Macroable;

    protected string $scheme;

    protected SchemeValidator $validator;

    public function __construct(
        string $scheme = '',
        array|null $allowedSchemes = null,
    ) {
        $this->validator = new SchemeValidator($allowedSchemes);

        $this->setScheme($scheme);
    }

    protected function validate(string $scheme): void
    {
        $this->validator->setScheme($scheme);

        $this->validator->validate();
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function setScheme(string $scheme): void
    {
        $sanitizedScheme = $this->validator::sanitizeScheme($scheme);

        $this->validate($sanitizedScheme);

        $this->scheme = $sanitizedScheme;
    }

    public function getAllowedSchemes(): array
    {
        return $this->validator->getAllowedSchemes();
    }

    public function setAllowedSchemes(array $allowedSchemes): void
    {
        $this->validator->setAllowedSchemes($allowedSchemes);
    }

    public function __toString(): string
    {
        return $this->getScheme();
    }

    public function __clone()
    {
        $this->validator = clone $this->validator;
    }
}
