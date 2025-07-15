<?php

namespace Spatie\Url;

use Psr\Http\Message\UriInterface;
use Spatie\Macroable\Macroable;
use Spatie\Url\Exceptions\InvalidArgument;
use Stringable;

class Url implements UriInterface, Stringable
{
    use Macroable;

    /**
     * @var Scheme
     */
    protected Scheme $scheme;

    /**
     * @var string
     */
    protected string $host = '';

    /**
     * @var int|null
     */
    protected ?int $port = null;

    /**
     * @var string
     */
    protected string $user = '';

    /**
     * @var string|null
     */
    protected ?string $password = null;

    /**
     * @var string
     */
    protected string $path = '';

    /**
     * @var QueryParameterBag
     */
    protected QueryParameterBag $query;

    /**
     * @var string
     */
    protected string $fragment = '';

    /**
     *
     */
    public function __construct()
    {
        $this->scheme = new Scheme();
        $this->query = new QueryParameterBag();
    }

    /**
     * @return static
     */
    public static function create(): static
    {
        return new static();
    }

    /**
     * @param string     $url
     * @param array|null $allowedSchemes
     *
     * @return static
     */
    public static function fromString(string $url, array|null $allowedSchemes = null): static
    {
        $toUrl = new static();

        if ($allowedSchemes !== null) {
            $toUrl = $toUrl->withAllowedSchemes($allowedSchemes);
        }

        return static::make($url, $toUrl);
    }

    /**
     * @param string $fromUrl
     * @param Url    $toUrl
     *
     * @throws InvalidArgument
     *
     * @return static
     */
    protected static function make(string $fromUrl, self $toUrl): static
    {
        if (! $parts = parse_url($fromUrl)) {
            throw InvalidArgument::invalidUrl($fromUrl);
        }

        $toUrl->scheme->setScheme(isset($parts['scheme']) ? $parts['scheme'] : '');
        $toUrl->host = $parts['host'] ?? '';
        $toUrl->port = $parts['port'] ?? null;
        $toUrl->user = $parts['user'] ?? '';
        $toUrl->password = $parts['pass'] ?? null;
        $toUrl->path = $parts['path'] ?? '/';
        $toUrl->query = QueryParameterBag::fromString($parts['query'] ?? '');
        $toUrl->fragment = $parts['fragment'] ?? '';

        return $toUrl;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
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

    /**
     * @return string
     */
    public function getUserInfo(): string
    {
        $userInfo = $this->user;

        if ($this->password !== null) {
            $userInfo .= ':'.$this->password;
        }

        return $userInfo;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getBasename(): string
    {
        return $this->getSegment(-1);
    }

    /**
     * @return string
     */
    public function getDirname(): string
    {
        $segments = $this->getSegments();

        array_pop($segments);

        return '/'.implode('/', $segments);
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return (string) $this->query;
    }

    /**
     * @param string     $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function getQueryParameter(string $key, mixed $default = null): mixed
    {
        return $this->query->get($key, $default);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasQueryParameter(string $key): bool
    {
        return $this->query->has($key);
    }

    /**
     * @return array
     */
    public function getAllQueryParameters(): array
    {
        return $this->query->all();
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function withQueryParameter(string $key, string $value): static
    {
        $url = clone $this;
        $url->query->unset($key);

        $url->query->set($key, $value);

        return $url;
    }

    /**
     * @param array $parameters
     *
     * @return $this
     */
    public function withQueryParameters(array $parameters): static
    {
        $parameters = array_merge($this->getAllQueryParameters(), $parameters);
        $url = clone $this;
        $url->query = new QueryParameterBag($parameters);

        return $url;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function withoutQueryParameter(string $key): static
    {
        $url = clone $this;
        $url->query->unset($key);

        return $url;
    }

    /**
     * @return $this
     */
    public function withoutQueryParameters(): static
    {
        $url = clone $this;
        $url->query->unsetAll();

        return $url;
    }

    /**
     * @return string
     */
    public function getFragment(): string
    {
        return $this->fragment;
    }

    /**
     * @return string[]
     */
    public function getSegments(): array
    {
        return explode('/', trim($this->path, '/'));
    }

    /**
     * @param int        $index
     * @param mixed|null $default
     *
     * @throws InvalidArgument
     *
     * @return mixed
     */
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

    /**
     * @return string|null
     */
    public function getFirstSegment(): ?string
    {
        $segments = $this->getSegments();

        return $segments[0] ?? null;
    }

    /**
     * @return string|bool|null
     */
    public function getLastSegment(): string|bool|null
    {
        $segments = $this->getSegments();

        return end($segments) ?? null;
    }

    /**
     * @param $scheme
     *
     * @return $this
     */
    public function withScheme($scheme): static
    {
        $url = clone $this;

        $url->scheme->setScheme($scheme);

        return $url;
    }

    /**
     * @param array $schemes
     *
     * @return $this
     */
    public function withAllowedSchemes(array $schemes): static
    {
        $url = clone $this;

        $url->scheme->setAllowedSchemes($schemes);

        return $url;
    }

    /**
     * @param $user
     * @param $password
     *
     * @return $this
     */
    public function withUserInfo($user, $password = null): static
    {
        $url = clone $this;

        $url->user = $user;
        $url->password = $password;

        return $url;
    }

    /**
     * @param $host
     *
     * @return $this
     */
    public function withHost($host): static
    {
        $url = clone $this;

        $url->host = $host;

        return $url;
    }

    /**
     * @param $port
     *
     * @return $this
     */
    public function withPort($port): static
    {
        $url = clone $this;

        $url->port = $port;

        return $url;
    }

    /**
     * @param $path
     *
     * @return $this
     */
    public function withPath($path): static
    {
        $url = clone $this;

        if (! str_starts_with($path, '/')) {
            $path = '/'.$path;
        }

        $url->path = $path;

        return $url;
    }

    /**
     * @param string $dirname
     *
     * @return $this
     */
    public function withDirname(string $dirname): static
    {
        $dirname = trim($dirname, '/');

        if (! $this->getBasename()) {
            return $this->withPath($dirname);
        }

        return $this->withPath($dirname.'/'.$this->getBasename());
    }

    /**
     * @param string $basename
     *
     * @return $this
     */
    public function withBasename(string $basename): static
    {
        $basename = trim($basename, '/');

        if ($this->getDirname() === '/') {
            return $this->withPath('/'.$basename);
        }

        return $this->withPath($this->getDirname().'/'.$basename);
    }

    /**
     * @param $query
     *
     * @return $this
     */
    public function withQuery($query): static
    {
        $url = clone $this;

        $url->query = QueryParameterBag::fromString($query);

        return $url;
    }

    /**
     * @param $fragment
     *
     * @return $this
     */
    public function withFragment($fragment): static
    {
        $url = clone $this;

        $url->fragment = $fragment;

        return $url;
    }

    /**
     * @param Url $url
     *
     * @return bool
     */
    public function matches(self $url): bool
    {
        return (string) $this === (string) $url;
    }

    /**
     * @return string
     */
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

    /**
     * @return void
     */
    public function __clone()
    {
        $this->query = clone $this->query;
        $this->scheme = clone $this->scheme;
    }
}
