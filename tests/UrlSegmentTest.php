<?php

namespace Spatie\Url\Test;

use Spatie\Url\Exceptions\InvalidArgument;
use Spatie\Url\Url;

class UrlSegmentTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_return_all_path_segments()
    {
        $url = Url::create()->withPath('opensource/php');

        $this->assertEquals(['opensource', 'php'], $url->getSegments());
    }

    /** @test */
    public function it_can_return_a_path_segment()
    {
        $url = Url::create()->withPath('opensource/php');

        $this->assertEquals('opensource', $url->getSegment(1));
        $this->assertEquals('php', $url->getSegment(2));
    }

    /** @test */
    public function it_returns_null_if_a_path_segment_doesnt_exist()
    {
        $url = Url::create()->withPath('opensource/php');

        $this->assertNull($url->getSegment(3));
    }

    /** @test */
    public function it_can_return_a_default_if_a_path_segment_doesnt_exist()
    {
        $url = Url::create()->withPath('opensource/php');

        $this->assertEquals('nothing', $url->getSegment(3, 'nothing'));
    }

    /** @test */
    public function it_throws_an_exception_if_segment_0_gets_queried()
    {
        $this->expectException(InvalidArgument::class);

        Url::create()->withPath('opensource/php')->getSegment(0);
    }

    /** @test */
    public function it_can_return_a_path_segment_counting_from_behind()
    {
        $url = Url::create()->withPath('opensource/php');

        $this->assertEquals('php', $url->getSegment(-1));
    }
}
