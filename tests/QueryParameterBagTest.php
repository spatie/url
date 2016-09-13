<?php

namespace Spatie\Url\Test;

use Spatie\Url\QueryParameterBag;

class QueryParameterBagTest
{
    /** @test */
    public function it_can_get_a_parameter()
    {
        $queryParameterBag = new QueryParameterBag(['offset' => 10]);

        $this->assertEquals(10, $queryParameterBag->get('offset'));
    }

    /** @test */
    public function it_returns_null_if_a_parameter_doesnt_exist()
    {
        $queryParameterBag = new QueryParameterBag(['offset' => 10]);

        $this->assertNull(10, $queryParameterBag->get('limit'));
    }

    /** @test */
    public function it_can_return_a_default_if_a_parameter_doesnt_exist()
    {
        $queryParameterBag = new QueryParameterBag(['offset' => 10]);

        $this->assertEquals(20, $queryParameterBag->get('limit', 20));
    }

    /** @test */
    public function it_can_set_a_parameter()
    {
        $queryParameterBag = new QueryParameterBag([]);

        $queryParameterBag->set('offset', 10);

        $this->assertNull(10, $queryParameterBag->get('offset'));
    }

    /** @test */
    public function it_can_check_if_it_has_a_parameter()
    {
        $queryParameterBag = new QueryParameterBag(['offset' => 10]);

        $this->assertTrue($queryParameterBag->has('offset'));
        $this->assertFalse($queryParameterBag->has('limit'));
    }

    /** @test */
    public function if_can_unset_a_parameter()
    {
        $queryParameterBag = new QueryParameterBag(['offset' => 10]);

        $queryParameterBag->unset('offset');

        $this->assertFalse($queryParameterBag->has('offset'));
    }
}
