<?php

namespace Spatie\Url;

use Spatie\Url\Helpers\Arr;

class QueryParameterBag
{
    /** @var array */
    protected $parameters;

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public static function fromString(string $query = ''): QueryParameterBag
    {
        if ($query === '') {
            return new static();
        }

        return new static(Arr::mapToAssoc(explode('&', $query), function (string $keyValue) {
            return explode('=', $keyValue, 2);
        }));
    }

    public function get(string $key, $default = null)
    {
        return $this->parameters[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->parameters);
    }

    public function set(string $key, string $value)
    {
        $this->parameters[$key] = $value;
    }

    public function unset(string $key)
    {
        unset($this->parameters[$key]);
    }

    public function all(): array
    {
        return $this->parameters;
    }

    public function __toString()
    {
        $keyValuePairs = Arr::map($this->parameters, function ($value, $key) {
            return "{$key}={$value}";
        });

        return implode('&', $keyValuePairs);
    }
}
