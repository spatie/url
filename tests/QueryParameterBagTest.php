<?php

use Spatie\Url\QueryParameterBag;

it('can get a parameter', function () {
    $queryParameterBag = new QueryParameterBag(['offset' => 10]);

    expect($queryParameterBag)->get('offset')->toEqual(10);
});


it('returns null if a parameter doesnt exist', function () {
    $queryParameterBag = new QueryParameterBag(['offset' => 10]);

    expect($queryParameterBag)->get('limit')->toBeNull();
});


it('can return a default if a parameter doesnt exist', function () {
    $queryParameterBag = new QueryParameterBag(['offset' => 10]);

    expect($queryParameterBag)->get('limit', 20)->toEqual(20);
});


it('can_return_all_parameters', function () {
    $queryParameterBag = new QueryParameterBag(['offset' => 10]);

    expect($queryParameterBag)->all()->toEqual(['offset' => 10]);
});


it('can set a string parameter', function () {
    $queryParameterBag = new QueryParameterBag([]);

    $queryParameterBag->set('offset', 10);

    expect($queryParameterBag)->get('offset')->toEqual(10);
});

it('can set an array parameter', function () {
    $queryParameterBag = new QueryParameterBag([]);

    $queryParameterBag->set('range', [10, 20]);

    expect($queryParameterBag)->get('range')->toEqual([10, 20]);
});


it('can check if it has a parameter', function () {
    $queryParameterBag = new QueryParameterBag(['offset' => 10]);

    expect($queryParameterBag)->has('offset')->toBeTrue();
    expect($queryParameterBag)->has('limit')->toBeFalse();
});


it('can unset a parameter', function () {
    $queryParameterBag = new QueryParameterBag(['offset' => 10]);

    $queryParameterBag->unset('offset');

    expect($queryParameterBag)->has('offset')->toBeFalse();
});


it('can be created from a string', function () {
    $queryParameterBag = QueryParameterBag::fromString('offset=10&limit=20');

    expect($queryParameterBag)->get('offset')->toEqual('10');
    expect($queryParameterBag)->get('limit')->toEqual('20');
});


it('can be created from an empty string', function () {
    $queryParameterBag = QueryParameterBag::fromString('');

    expect($queryParameterBag)->all()->toEqual([]);
});


it('can be casted to a string', function () {
    $queryParameterBag = QueryParameterBag::fromString('offset=10&limit=20');

    expect($queryParameterBag)->__toString()->toEqual('offset=10&limit=20');
});


it('can be created from a string with url encoded values', function () {
    $queryParameterBag = QueryParameterBag::fromString(
        'category=storage%20furniture&discount=%3E40%25%20off&range%5B0%5D=10&range%5B1%5D=20'
    );

    expect($queryParameterBag)->get('category')->toEqual('storage furniture');
    expect($queryParameterBag)->get('discount')->toEqual('>40% off');
    expect($queryParameterBag)->get('range')->toEqual([10, 20]);
});


it('url encodes values when being casted to a string', function () {
    $queryParameterBag = new QueryParameterBag([]);

    $queryParameterBag->set('category', 'storage furniture');
    $queryParameterBag->set('discount', '>40% off');
    $queryParameterBag->set('range', [10, 20]);

    expect($queryParameterBag)->__toString()->toEqual('category=storage%20furniture&discount=%3E40%25%20off&range%5B0%5D=10&range%5B1%5D=20');
});

it('unsets all query parameters', function () {
   $queryParameterBag = QueryParameterBag::fromString(
       'category=storage%20furniture&discount=%3E40%25%20off&range%5B0%5D=10&range%5B1%5D=20'
   )->unsetAll();

   expect($queryParameterBag)->all()->toEqual([]);
});
