<?php

namespace Spatie\Url;

use Exception;
use Psr\Http\Message\UriInterface;

class Url implements UriInterface
{
    /** @var string */
    protected $scheme = '';

    /** @var string */
    protected $host = '';

    /** @var int|null */
    protected $port = null;

    /** @var string */
    protected $user = '';

    /** @var string|null */
    protected $password = null;

    /** @var string */
    protected $path = '';

    /** @var string */
    protected $query = '';

    /** @var string */
    protected $fragment = '';

    const VALID_SCHEMES = ['http', 'https'];

    public static function fromString(string $url): Url
    {
        $parts = parse_url($url);

        $url = new static();
        $url->scheme = $parts['scheme'] ?? '';
        $url->host = $parts['host'] ?? '';
        $url->port = $parts['port'] ?? null;
        $url->user = $parts['user'] ?? '';
        $url->password = $parts['password'] ?? null;
        $url->path = $parts['path'] ?? '';
        $url->query = $parts['query'] ?? '';
        $url->fragment = $parts['fragment'] ?? '';

        return $url;
    }

    public function getScheme()
    {
        return $this->scheme;
    }

    public function getAuthority()
    {
        $authority = $this->host;

        if ($this->getUserInfo()) {
            $authority = $this->getUserInfo().'@'.$authority;
        }

        if ($this->port) {
            $authority .= ':'.$this->port;
        }

        return $authority;
    }

    public function getUserInfo()
    {
        $userInfo = $this->user;

        if ($this->password !== null) {
            $userInfo .= ':'.$this->password;
        }

        return $userInfo;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getFragment()
    {
        return $this->fragment;
    }

    public function withScheme($scheme)
    {
        $scheme = strtolower($scheme);

        if (in_array($scheme, static::VALID_SCHEMES)) {
            throw new Exception();
        }

        $url = clone $this;
        $url->scheme = $scheme;

        return $url;
    }

    public function withUserInfo($user, $password = null)
    {
        $url = clone $this;
        $url->user = $user;
        $url->password = $password;

        return $url;
    }

    public function withHost($host)
    {
        $url = clone $this;
        $url->host = $host;

        return $url;
    }

    public function withPort($port)
    {
        $url = clone $this;
        $url->port = $port;

        return $url;
    }

    public function withPath($path)
    {
        $url = clone $this;

        $path = $this->parsePath($path);

        $url->basename = $path['basename'];
        $url->dirname = $path['dirname'];

        return $url;
    }

    public function withQuery($query)
    {
        $url = clone $this;
        $url->query = $query;

        return $url;
    }

    public function withFragment($fragment)
    {
        $url = clone $this;
        $url->fragment = $fragment;

        return $url;
    }

    public function __toString()
    {
        $url = '';

        if ($this->getScheme() !== '') {
            $url .= $this->getScheme().'://';
        }

        if ($this->getScheme() === '' && $this->getAuthority() !== '') {
            $url .= '//';
        }

        if ($this->getAuthority() !== '') {
            $url .= $this->getAuthority();
        }

        $url .= $this->getPath();

        if ($this->getQuery() !== '') {
            $url .= '?'.$this->getQuery();
        }

        if ($this->getFragment() !== '') {
            $url .= '#'.$this->getFragment();
        }

        return $url;
    }
}
