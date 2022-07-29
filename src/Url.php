<?php

namespace Spatie\Url;

use Psr\Http\Message\UriInterface;
use Spatie\Macroable\Macroable;
use Spatie\Url\Exceptions\InvalidArgument;
use Stringable;

class Url implements UriInterface, Stringable
{
    use Macroable;

    protected string $scheme = '';

    protected string $host = '';

    protected ?int $port = null;

    protected string $user = '';

    protected ?string $password = null;

    protected string $path = '';

    protected QueryParameterBag $query;

    protected string $fragment = '';

    public const VALID_SCHEMES = ['http', 'https', 'mailto', 'tel'];

    public function __construct()
    {
        $this->query = new QueryParameterBag();
    }

    public static function create(): static
    {
        return new static();
    }

    public static function fromString(string $url): static
    {
        if (! $parts = parse_url($url)) {
            throw InvalidArgument::invalidUrl($url);
        }

        $url = new static();
        $url->scheme = isset($parts['scheme']) ? $url->sanitizeScheme($parts['scheme']) : '';
        $url->host = $parts['host'] ?? '';
        $url->port = $parts['port'] ?? null;
        $url->user = $parts['user'] ?? '';
        $url->password = $parts['pass'] ?? null;
        $url->path = $parts['path'] ?? '/';
        $url->query = QueryParameterBag::fromString($parts['query'] ?? '');
        $url->fragment = $parts['fragment'] ?? '';

        return $url;
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getAuthority(): string
    {
        $authority = $this->host;

        if ($this->getUserInfo()) {
            $authority = $this->getUserInfo().'@'.$authority;
        }

        if ($this->port !== null) {
            $authority .= ':'.$this->port;
        }

        return $authority;
    }

    public function getUserInfo(): string
    {
        $userInfo = $this->user;

        if ($this->password !== null) {
            $userInfo .= ':'.$this->password;
        }

        return $userInfo;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getBasename(): string
    {
        return $this->getSegment(-1);
    }

    public function getDirname(): string
    {
        $segments = $this->getSegments();

        array_pop($segments);

        return '/'.implode('/', $segments);
    }

    public function getQuery(): string
    {
        return (string) $this->query;
    }

    public function getQueryParameter(string $key, mixed $default = null): mixed
    {
        return $this->query->get($key, $default);
    }

    public function hasQueryParameter(string $key): bool
    {
        return $this->query->has($key);
    }

    public function getAllQueryParameters(): array
    {
        return $this->query->all();
    }

    public function withQueryParameter(string $key, string $value): static
    {
        $url = clone $this;
        $url->query->unset($key);

        $url->query->set($key, $value);

        return $url;
    }

    public function withQueryParameters(array $parameters): static
    {
        $parameters = array_merge($this->getAllQueryParameters(), $parameters);
        $url = clone $this;
        $url->query = new QueryParameterBag($parameters);

        return $url;
    }

    public function withoutQueryParameter(string $key): static
    {
        $url = clone $this;
        $url->query->unset($key);

        return $url;
    }

    public function withoutQueryParameters(): static
    {
        $url = clone $this;
        $url->query->unsetAll();

        return $url;
    }

    public function getFragment(): string
    {
        return $this->fragment;
    }

    public function getSegments(): array
    {
        return explode('/', trim($this->path, '/'));
    }

    public function getSegment(int $index, mixed $default = null): mixed
    {
        $segments = $this->getSegments();

        if ($index === 0) {
            throw InvalidArgument::segmentZeroDoesNotExist();
        }

        if ($index < 0) {
            $segments = array_reverse($segments);
            $index = abs($index);
        }

        return $segments[$index - 1] ?? $default;
    }

    public function getFirstSegment(): mixed
    {
        $segments = $this->getSegments();

        return $segments[0] ?? null;
    }

    public function getLastSegment(): mixed
    {
        $segments = $this->getSegments();

        return end($segments) ?? null;
    }

    public function withScheme($scheme): static
    {
        $url = clone $this;

        $url->scheme = $this->sanitizeScheme($scheme);

        return $url;
    }

    protected function sanitizeScheme(string $scheme): string
    {
        $scheme = strtolower($scheme);

        if (! in_array($scheme, static::VALID_SCHEMES)) {
            throw InvalidArgument::invalidScheme($scheme);
        }

        return $scheme;
    }

    public function withUserInfo($user, $password = null): static
    {
        $url = clone $this;

        $url->user = $user;
        $url->password = $password;

        return $url;
    }

    public function withHost($host): static
    {
        $url = clone $this;

        $url->host = $host;

        return $url;
    }

    public function withPort($port): static
    {
        $url = clone $this;

        $url->port = $port;

        return $url;
    }

    public function withPath($path): static
    {
        $url = clone $this;

        if (! str_starts_with($path, '/')) {
            $path = '/'.$path;
        }

        $url->path = $path;

        return $url;
    }

    public function withDirname(string $dirname): static
    {
        $dirname = trim($dirname, '/');

        if (! $this->getBasename()) {
            return $this->withPath($dirname);
        }

        return $this->withPath($dirname.'/'.$this->getBasename());
    }

    public function withBasename(string $basename): static
    {
        $basename = trim($basename, '/');

        if ($this->getDirname() === '/') {
            return $this->withPath('/'.$basename);
        }

        return $this->withPath($this->getDirname().'/'.$basename);
    }

    public function withQuery($query): static
    {
        $url = clone $this;

        $url->query = QueryParameterBag::fromString($query);

        return $url;
    }

    public function withFragment($fragment): static
    {
        $url = clone $this;

        $url->fragment = $fragment;

        return $url;
    }

    public function matches(self $url): bool
    {
        return (string) $this === (string) $url;
    }

    public function __toString(): string
    {
        $url = '';

        if ($this->getScheme() !== '' && ! in_array($this->getScheme(), ['mailto', 'tel'], true)) {
            $url .= $this->getScheme().'://';
        }

        if (in_array($this->getScheme(), ['mailto', 'tel'], true) && $this->getPath() !== '') {
            $url .= $this->getScheme().':';
        }

        if ($this->getScheme() === '' && $this->getAuthority() !== '') {
            $url .= '//';
        }

        if ($this->getAuthority() !== '') {
            $url .= $this->getAuthority();
        }

        if ($this->getPath() !== '/') {
            $path = in_array($this->getScheme(), ['mailto', 'tel'], true)
                ? ltrim($this->getPath(), '/')
                : $this->getPath();

            $url .= $path;
        }

        if ($this->getQuery() !== '') {
            $url .= '?'.$this->getQuery();
        }

        if ($this->getFragment() !== '') {
            $url .= '#'.$this->getFragment();
        }

        return $url;
    }

    public function __clone()
    {
        $this->query = clone $this->query;
    }
}
