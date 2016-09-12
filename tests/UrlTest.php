<?php

namespace Spatie\Url\Test;

use Spatie\Url\Url;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_parse_and_rebuild_a_simple_url()
    {
        $url = Url::fromString('https://spatie.be');

        $this->assertEquals('https', $url->getScheme());
        $this->assertEquals('spatie.be', $url->getHost());
        $this->assertEquals('https://spatie.be', $url->__toString());
    }
}
