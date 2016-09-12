<?php

namespace Spatie\Url\Test;

use Spatie\Url\Url;

class UrlImmutableTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function with_scheme_returns_a_new_instance()
    {
        $url = Url::fromString('http://spatie.be');

        $secured = $url->withScheme('https');

        $this->assertEquals('http', $url->getScheme());
        $this->assertEquals('https', $secured->getScheme());
    }
}
