<?php

namespace Spatie\Url\Test;

use Spatie\Url\Url;
use Spatie\Url\Exceptions\InvalidArgument;

class UrlBuildTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_build_a_url_with_a_host()
    {
        $url = Url::create()->withHost('spatie.be');

        $this->assertEquals('//spatie.be', $url->__toString());
    }

    /** @test */
    public function it_can_build_a_url_with_a_scheme()
    {
        $url = Url::create()
            ->withScheme('https')
            ->withHost('spatie.be');

        $this->assertEquals('https://spatie.be', $url->__toString());
    }

    /** @test */
    public function it_can_convert_itself_back_to_a_string()
    {
        $url = Url::fromString('https://spatie.be/');

        $this->assertEquals('https://spatie.be', $url->__toString());
    }

    /** @test */
    public function it_throws_an_exception_when_providing_an_invalid_url_scheme()
    {
        $this->expectException(InvalidArgument::class);
        $this->expectExceptionMessage(InvalidArgument::invalidScheme('htps')->getMessage());

        Url::create()->withScheme('htps');
    }

    /** @test */
    public function it_can_build_a_url_with_a_user()
    {
        $url = Url::create()
            ->withHost('spatie.be')
            ->withUserInfo('sebastian');

        $this->assertEquals('//sebastian@spatie.be', $url->__toString());
    }

    /** @test */
    public function it_can_build_a_url_with_a_user_and_a_password()
    {
        $url = Url::create()
            ->withHost('spatie.be')
            ->withUserInfo('sebastian', 'supersecret');

        $this->assertEquals('//sebastian:supersecret@spatie.be', $url->__toString());
    }

    /** @test */
    public function it_can_build_a_url_with_a_port()
    {
        $url = Url::create()
            ->withHost('spatie.be')
            ->withPort(9000);

        $this->assertEquals('//spatie.be:9000', $url->__toString());
    }

    /** @test */
    public function it_can_build_a_url_with_a_path()
    {
        $url = Url::create()
            ->withHost('spatie.be')
            ->withPath('/opensource');

        $this->assertEquals('//spatie.be/opensource', $url->__toString());
    }

    /** @test */
    public function it_prefixes_paths_with_a_slash_if_its_not_present()
    {
        $url = Url::create()
            ->withHost('spatie.be')
            ->withPath('opensource');

        $this->assertEquals('/opensource', $url->getPath());
    }

    /** @test */
    public function it_can_build_a_url_with_a_dirname()
    {
        $url = Url::create()
            ->withHost('spatie.be')
            ->withDirname('opensource');

        $this->assertEquals('//spatie.be/opensource', $url->__toString());
    }

    /** @test */
    public function it_can_build_a_url_with_a_basename()
    {
        $url = Url::create()
            ->withHost('spatie.be')
            ->withPath('/opensource/php')
            ->withBasename('laravel');

        $this->assertEquals('//spatie.be/opensource/laravel', $url->__toString());
    }

    /** @test */
    public function it_can_build_a_url_with_a_query()
    {
        $url = Url::create()
            ->withHost('spatie.be')
            ->withQuery('utm_source=phpunit');

        $this->assertEquals('//spatie.be?utm_source=phpunit', $url->__toString());
    }

    /** @test */
    public function it_can_build_a_url_with_a_fragment()
    {
        $url = Url::create()
            ->withHost('spatie.be')
            ->withFragment('bottom-of-page');

        $this->assertEquals('//spatie.be#bottom-of-page', $url->__toString());
    }

    /** @test */
    public function it_can_build_a_url_with_the_full_monty()
    {
        $url = Url::create()
            ->withScheme('https')
            ->withUserInfo('sebastian', 'supersecret')
            ->withHost('spatie.be')
            ->withPort(9000)
            ->withPath('/opensource')
            ->withQuery('utm_source=phpunit')
            ->withFragment('bottom-of-page');

        $this->assertEquals(
            'https://sebastian:supersecret@spatie.be:9000/opensource?utm_source=phpunit#bottom-of-page',
            $url->__toString()
        );
    }

    /** @test */
    public function it_prefixes_the_path_if_the_url_has_an_authority_but_is_rootless()
    {
        $url = Url::create()
            ->withUserInfo('sebastian', 'supersecret')
            ->withPort(9000)
            ->withPath('opensource');

        $this->assertEquals('//sebastian:supersecret@:9000/opensource', $url->__toString());
    }
}
