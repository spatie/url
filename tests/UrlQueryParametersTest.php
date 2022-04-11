<?php

use Spatie\Url\Url;

it('can get a query parameter', function () {
    $url = Url::create()->withQuery('offset=10');

    expect($url)->getQueryParameter('offset')->toEqual('10');
});


it('returns null if a query parameter doesnt exist', function () {
    $url = Url::create()->withQuery('offset=10');

    expect($url)->getQueryParameter('limit')->toBeNull();
});


it('can return a default if a query parameter doesnt exist', function () {
    $url = Url::create()->withQuery('offset=10');

    expect($url)->getQueryParameter('limit', 20)->toEqual(20);
});


it('can return all parameters', function () {
    $url = Url::create()->withQuery('offset=10');

    expect($url)->getAllQueryParameters()->toEqual(['offset' => 10]);
});


it('can set a query parameter', function () {
    $url = Url::create()->withQueryParameter('offset', 10);

    expect($url)->getQueryParameter('offset')->toEqual('10');
});


it('can set multiple query parameters', function () {
    $url = Url::create()->withQueryParameters(['offset' => 10, 'limit' => 5]);

    expect($url)->getQueryParameter('offset')->toEqual('10');
    expect($url)->getQueryParameter('limit')->toEqual('5');
});


it('merges multiple query parameters', function () {
    $url = Url::create()->withQuery('offset=10')->withQueryParameters(['limit' => 5]);

    expect($url)->hasQueryParameter('offset')->toBeTrue();
    expect($url)->hasQueryParameter('limit')->toBeTrue();
});


it('can check if it has a query parameter', function () {
    $url = Url::create()->withQuery('offset=10');

    expect($url)->hasQueryParameter('offset')->toBeTrue();
    expect($url)->hasQueryParameter('limit')->toBeFalse();
});


it('can unset a query parameter', function () {
    $url = Url::create()
              ->withQuery('offset=10')
              ->withoutQueryParameter('offset');

    expect($url)->hasQueryParameter('offset')->toBeFalse();
});


it('can handle empty query parameters', function () {
    $url = Url::create()->withQuery('offset');

    expect($url)->hasQueryParameter('offset')->toBeTrue();
});


test('empty query parameters default to null', function () {
    $url = Url::create()->withQuery('offset');

    expect($url)->getQueryParameter('offset')->toBeNull();
});
