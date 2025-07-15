<?php

namespace Spatie\Url;

use Spatie\Macroable\Macroable;
use Stringable;

class Scheme implements Stringable
{
    use Macroable;

    /**
     * @var string
     */
    protected string $scheme;

    /**
     * @var SchemeValidator
     */
    protected SchemeValidator $validator;

    /**
     * @param string     $scheme
     * @param array|null $allowedSchemes
     */
    public function __construct(
        string $scheme = '',
        array|null $allowedSchemes = null,
    ) {
        $this->validator = new SchemeValidator($allowedSchemes);

        $this->setScheme($scheme);
    }

    /**
     * @param string $scheme
     *
     * @return void
     */
    protected function validate(string $scheme): void
    {
        $this->validator->setScheme($scheme);

        $this->validator->validate();
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     *
     * @return void
     */
    public function setScheme(string $scheme): void
    {
        $sanitizedScheme = $this->validator::sanitizeScheme($scheme);

        $this->validate($sanitizedScheme);

        $this->scheme = $sanitizedScheme;
    }

    /**
     * @return array
     */
    public function getAllowedSchemes(): array
    {
        return $this->validator->getAllowedSchemes();
    }

    /**
     * @param array $allowedSchemes
     *
     * @return void
     */
    public function setAllowedSchemes(array $allowedSchemes): void
    {
        $this->validator->setAllowedSchemes($allowedSchemes);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getScheme();
    }

    /**
     * @return void
     */
    public function __clone()
    {
        $this->validator = clone $this->validator;
    }
}
