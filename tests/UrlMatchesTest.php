<?php

namespace Spatie\Url\Test;

use Spatie\Url\Url;
use PHPUnit\Framework\TestCase;

class UrlMatchesTest extends TestCase
{
    /** @test */
    public function it_can_check_if_it_matches_another_url()
    {
        $url = Url::fromString('https://spatie.be');

        $this->assertTrue($url->matches(Url::fromString('https://spatie.be/')));
    }

    /** @test */
    public function it_can_check_if_it_doesnt_match_another_url()
    {
        $url = Url::fromString('https://spatie.be');

        $this->assertFalse($url->matches(Url::fromString('https://spatie.be/opensource')));
    }
}
