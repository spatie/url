<?php

namespace Spatie\Url\Test;

use Spatie\Url\Url;

class UrlQueryParametersTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_get_a_query_parameter()
    {
        $url = Url::create()->withQuery('offset=10');

        $this->assertEquals(10, $url->getQueryParameter('offset'));
    }

    /** @test */
    public function it_can_get_an_empty_query_parameter()
    {
        $url = Url::create()->withQuery('offset=10&a');

        $this->assertEquals('', $url->getQueryParameter('a'));
        $this->assertEquals(10, $url->getQueryParameter('offset'));
    }

    /** @test */
    public function it_returns_null_if_a_query_parameter_doesnt_exist()
    {
        $url = Url::create()->withQuery('offset=10');

        $this->assertNull($url->getQueryParameter('limit'));
    }

    /** @test */
    public function it_can_return_a_default_if_a_query_parameter_doesnt_exist()
    {
        $url = Url::create()->withQuery('offset=10');

        $this->assertEquals(20, $url->getQueryParameter('limit', 20));
    }

    /** @test */
    public function it_can_return_all_parameters()
    {
        $url = Url::create()->withQuery('offset=10');

        $this->assertEquals(['offset' => 10], $url->getAllQueryParameters());
    }

    /** @test */
    public function it_can_set_a_query_parameter()
    {
        $url = Url::create()->withQueryParameter('offset', 10);

        $this->assertEquals(10, $url->getQueryParameter('offset'));
    }

    /** @test */
    public function it_can_check_if_it_has_a_query_parameter()
    {
        $url = Url::create()->withQuery('offset=10');

        $this->assertTrue($url->hasQueryParameter('offset'));
        $this->assertFalse($url->hasQueryParameter('limit'));
    }

    /** @test */
    public function it_can_unset_a_query_parameter()
    {
        $url = Url::create()
            ->withQuery('offset=10')
            ->withoutQueryParameter('offset');

        $this->assertFalse($url->hasQueryParameter('offset'));
    }
}
