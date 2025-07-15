<?php

namespace Spatie\Url;

class QueryParameterBag implements \Stringable
{
    /**
     * @param array $parameters
     */
    public function __construct(
        protected array $parameters = [],
    ) {
        //
    }

    /**
     * @param string $query
     *
     * @return static
     */
    public static function fromString(string $query = ''): static
    {
        if ($query === '') {
            return new static();
        }

        $parameters = [];
        parse_str($query, $parameters);
        $parameters = array_map(fn ($param) => $param !== '' ? $param : null, $parameters);

        return new static($parameters);
    }

    /**
     * @param string     $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        if ($this->has($key)) {
            return $this->parameters[$key];
        }

        return is_callable($default) ? $default() : $default;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->parameters);
    }

    /**
     * @param string       $key
     * @param string|array $value
     *
     * @return $this
     */
    public function set(string $key, string|array $value): self
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function unset(string $key): self
    {
        unset($this->parameters[$key]);

        return $this;
    }

    /**
     * @return $this
     */
    public function unsetAll(): self
    {
        $this->parameters = [];

        return $this;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return http_build_query($this->parameters, '', '&', PHP_QUERY_RFC3986);
    }
}
