<?php

namespace Spatie\Url\Test;

use PHPUnit\Framework\TestCase;
use Spatie\Url\QueryParameterBag;

class QueryParameterBagTest extends TestCase
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

        $this->assertNull($queryParameterBag->get('limit'));
    }

    /** @test */
    public function it_can_return_a_default_if_a_parameter_doesnt_exist()
    {
        $queryParameterBag = new QueryParameterBag(['offset' => 10]);

        $this->assertEquals(20, $queryParameterBag->get('limit', 20));
    }

    /** @test */
    public function it_can_return_all_parameters()
    {
        $queryParameterBag = new QueryParameterBag(['offset' => 10]);

        $this->assertEquals(['offset' => 10], $queryParameterBag->all());
    }

    /** @test */
    public function it_can_set_a_parameter()
    {
        $queryParameterBag = new QueryParameterBag([]);

        $queryParameterBag->set('offset', 10);

        $this->assertEquals(10, $queryParameterBag->get('offset'));
    }

    /** @test */
    public function it_can_check_if_it_has_a_parameter()
    {
        $queryParameterBag = new QueryParameterBag(['offset' => 10]);

        $this->assertTrue($queryParameterBag->has('offset'));
        $this->assertFalse($queryParameterBag->has('limit'));
    }

    /** @test */
    public function it_can_unset_a_parameter()
    {
        $queryParameterBag = new QueryParameterBag(['offset' => 10]);

        $queryParameterBag->unset('offset');

        $this->assertFalse($queryParameterBag->has('offset'));
    }

    /** @test */
    public function it_can_be_created_from_a_string()
    {
        $queryParameterBag = QueryParameterBag::fromString('offset=10&limit=20');

        $this->assertEquals(10, $queryParameterBag->get('offset'));
        $this->assertEquals(20, $queryParameterBag->get('limit'));
    }

    /** @test */
    public function it_can_be_created_from_an_empty_string()
    {
        $queryParameterBag = QueryParameterBag::fromString('');

        $this->assertEquals([], $queryParameterBag->all());
    }

    /** @test */
    public function it_can_be_casted_to_a_string()
    {
        $queryParameterBag = QueryParameterBag::fromString('offset=10&limit=20');

        $this->assertEquals('offset=10&limit=20', $queryParameterBag->__toString());
    }

    /** @test */
    public function it_url_encodes_values_when_being_casted_to_a_string()
    {
        $queryParameterBag = new QueryParameterBag([]);

        $queryParameterBag->set('category', 'storage furniture');
        $queryParameterBag->set('discount', '>40% off');

        $this->assertEquals(
            'category=storage%20furniture&discount=%3E40%25%20off',
            $queryParameterBag->__toString()
        );
    }
}
