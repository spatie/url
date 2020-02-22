<?php

namespace Spatie\Url\Test;

use PHPUnit\Framework\TestCase;
use Spatie\Url\Exceptions\InvalidArgument;
use Spatie\Url\Url;

class UrlParseTest extends TestCase
{
    /** @test */
    public function it_can_parse_a_scheme()
    {
        $url = Url::fromString('https://spatie.be');

        $this->assertEquals('https', $url->getScheme());
    }

    /** @test */
    public function it_can_parse_a_scheme_that_uses_incorrect_casing()
    {
        $url = Url::fromString('HTTPS://SPATIE.BE');

        $this->assertEquals('https', $url->getScheme());
    }

    /** @test */
    public function it_can_parse_a_scheme_with_mailto()
    {
        $url = Url::fromString('mailto:email@domain.tld');

        $this->assertEquals('mailto', $url->getScheme());
    }

    /** @test */
    public function it_throws_an_exception_if_an_invalid_scheme_is_provided()
    {
        $this->expectException(InvalidArgument::class);
        $this->expectExceptionMessage(InvalidArgument::invalidScheme('htps')->getMessage());

        Url::fromString('htps://spatie.be');
    }

    /** @test */
    public function it_can_parse_a_host()
    {
        $url = Url::fromString('https://spatie.be');

        $this->assertEquals('spatie.be', $url->getHost());
    }

    /** @test */
    public function it_can_parse_a_path()
    {
        $url = Url::fromString('https://spatie.be/opensource');

        $this->assertEquals('/opensource', $url->getPath());
    }

    /** @test */
    public function it_preserves_a_trailing_slash_in_the_path()
    {
        $url = Url::fromString('https://spatie.be/opensource/');

        $this->assertEquals('/opensource/', $url->getPath());
    }

    /** @test */
    public function it_can_parse_an_empty_path()
    {
        $url = Url::fromString('https://spatie.be');

        $this->assertEquals('/', $url->getPath());
    }

    /** @test */
    public function it_can_parse_a_basename()
    {
        $url = Url::fromString('https://spatie.be/opensource/laravel');

        $this->assertEquals('laravel', $url->getBasename());
    }

    /** @test */
    public function it_can_parse_a_dirname()
    {
        $url = Url::fromString('https://spatie.be/opensource/laravel');

        $this->assertEquals('/opensource', $url->getDirname());
    }

    /** @test */
    public function it_can_parse_a_dirname_if_the_dir_is_the_root()
    {
        $url = Url::fromString('https://spatie.be/opensource');

        $this->assertEquals('/', $url->getDirname());
    }

    /** @test */
    public function it_can_parse_a_relative_url()
    {
        $url = Url::fromString('/opensource');

        $this->assertEquals('/opensource', $url->getPath());
    }

    /** @test */
    public function it_can_parse_a_query()
    {
        $url = Url::fromString('https://spatie.be?utm_source=phpunit');

        $this->assertEquals('utm_source=phpunit', $url->getQuery());
    }

    /** @test */
    public function it_can_parse_a_fragment()
    {
        $url = Url::fromString('https://spatie.be#bottom-of-page');

        $this->assertEquals('bottom-of-page', $url->getFragment());
    }

    /** @test */
    public function it_can_parse_user_info()
    {
        $url = Url::fromString('https://sebastian:supersecret@spatie.be');

        $this->assertEquals('sebastian:supersecret', $url->getUserInfo());
    }

    /** @test */
    public function it_can_parse_the_authority()
    {
        $url = Url::fromString('https://sebastian:supersecret@spatie.be:9000/opensource');

        $this->assertEquals('sebastian:supersecret@spatie.be:9000', $url->getAuthority());
    }
}
