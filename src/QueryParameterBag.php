<?php

namespace Spatie\Url;

use Spatie\Url\Helpers\Arr;

class QueryParameterBag implements \Stringable
{
    public function __construct(
        protected array $parameters = [],
    ) {
        //
    }

    public static function fromString(string $query = ''): static
    {
        if ($query === '') {
            return new static();
        }

        return new static(Arr::mapToAssoc(explode('&', $query), function (string $keyValue): array
        {
            $parts = explode('=', $keyValue, 2);

            return count($parts) === 2
                ? [$parts[0], rawurldecode($parts[1])]
                : [$parts[0], null];
        }));
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->parameters[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->parameters);
    }

    public function set(string $key, string $value): self
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    public function unset(string $key): self
    {
        unset($this->parameters[$key]);

        return $this;
    }

    public function all(): array
    {
        return $this->parameters;
    }

    public function __toString(): string
    {
        $keyValuePairs = Arr::map(
            $this->parameters,
            fn ($value, $key): string => "{$key}=".rawurlencode($value)
        );

        return implode('&', $keyValuePairs);
    }
}
