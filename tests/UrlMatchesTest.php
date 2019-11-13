<?php

namespace Spatie\Url\Test;

use PHPUnit\Framework\TestCase;
use Spatie\Url\Url;

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

    /** @test */
    public function it_can_check_if_it_contains_a_mailto()
    {
        $url = Url::fromString('mailto:email@domain.tld');

        $this->assertTrue($url->matches(Url::fromString('mailto:email@domain.tld')));
    }
}
