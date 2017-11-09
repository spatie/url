<?php

namespace Spatie\Url\Test;

use Spatie\Url\Url;
use PHPUnit\Framework\TestCase;

class UrlImmutableTest extends TestCase
{
    /** @test */
    public function with_scheme_returns_a_new_instance()
    {
        $url = Url::fromString('http://spatie.be');

        $clone = $url->withScheme('https');

        $this->assertEquals('http', $url->getScheme());
        $this->assertEquals('https', $clone->getScheme());
    }

    /** @test */
    public function with_user_info_returns_a_new_instance()
    {
        $url = Url::fromString('https://spatie.be');

        $clone = $url->withUserInfo('sebastian', 'supersecret');

        $this->assertEquals('', $url->getUserInfo());
        $this->assertEquals('sebastian:supersecret', $clone->getUserInfo());
    }

    /** @test */
    public function with_host_returns_a_new_instance()
    {
        $url = Url::fromString('https://spatie.be');

        $clone = $url->withHost('sebastiandedeyne.com');

        $this->assertEquals('spatie.be', $url->getHost());
        $this->assertEquals('sebastiandedeyne.com', $clone->getHost());
    }

    /** @test */
    public function with_port_returns_a_new_instance()
    {
        $url = Url::fromString('https://spatie.be');

        $clone = $url->withPort(9000);

        $this->assertEquals(0, $url->getPort());
        $this->assertEquals(9000, $clone->getPort());
    }

    /** @test */
    public function with_path_returns_a_new_instance()
    {
        $url = Url::fromString('https://spatie.be');

        $clone = $url->withPath('/opensource');

        $this->assertEquals('/', $url->getPath());
        $this->assertEquals('/opensource', $clone->getPath());
    }

    /** @test */
    public function with_query_returns_a_new_instance()
    {
        $url = Url::fromString('https://spatie.be');

        $clone = $url->withQuery('utm_source=phpunit');

        $this->assertEquals('', $url->getQuery());
        $this->assertEquals('utm_source=phpunit', $clone->getQuery());
    }

    /** @test */
    public function with_query_parameter_returns_a_new_instance()
    {
        $url = Url::fromString('https://spatie.be');

        $clone = $url->withQueryParameter('utm_source', 'phpunit');

        $this->assertEquals('', $url->getQuery());
        $this->assertEquals('utm_source=phpunit', $clone->getQuery());
    }

    /** @test */
    public function withput_query_parameter_returns_a_new_instance()
    {
        $url = Url::fromString('https://spatie.be')->withQueryParameter('utm_source', 'phpunit');

        $clone = $url->withoutQueryParameter('utm_source');

        $this->assertEquals('utm_source=phpunit', $url->getQuery());
        $this->assertEquals('', $clone->getQuery());
    }

    /** @test */
    public function with_fragment_returns_a_new_instance()
    {
        $url = Url::fromString('https://spatie.be');

        $clone = $url->withFragment('bottom-of-page');

        $this->assertEquals('', $url->getFragment());
        $this->assertEquals('bottom-of-page', $clone->getFragment());
    }
}
