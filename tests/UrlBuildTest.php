<?php

namespace Spatie\Url\Test;

use Spatie\Url\Exceptions\InvalidArgument;
use Spatie\Url\Url;

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
    public function it_throws_an_exception_when_providing_an_invalid_url_scheme()
    {
        $this->expectException(InvalidArgument::class);
        $this->expectExceptionMessage(InvalidArgument::invalidScheme('htps')->getMessage());
        Url::create()->withScheme('htps');
    }
}
