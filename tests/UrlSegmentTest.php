<?php

use Spatie\Url\Exceptions\InvalidArgument;
use Spatie\Url\Url;

it('can return all path segments', function () {
    $url = Url::create()->withPath('opensource/php');

    expect($url)->getSegments()->toEqual(['opensource', 'php']);
});


it('can return the last path segment', function () {
    $url = Url::create()->withPath('opensource/php');

    $this->assertEquals('php', $url->getLastSegment());
    expect($url)->getLastSegment()->toEqual('php');
});


it('can return the first path segment', function () {
    $url = Url::create()->withPath('opensource/php');

    $this->assertEquals('opensource', $url->getFirstSegment());
    expect($url)->getFirstSegment()->toEqual('opensource');
});


it('can return a path segment', function () {
    $url = Url::create()->withPath('opensource/php');

    expect($url)->getSegment(1)->toEqual('opensource');
    expect($url)->getSegment(2)->toEqual('php');
});


it('returns null if a path segment doesnt exist', function () {
    $url = Url::create()->withPath('opensource/php');

    $this->assertNull($url->getSegment(3));
    expect($url)->getSegment(3)->toBeNull();
});

it('can return a default if a path segment doesnt exist', function () {
    $url = Url::create()->withPath('opensource/php');

    expect($url)->getSegment(3, 'nothing')->toEqual('nothing');
});

it('throws an exception if segment 0 gets queried', function () {
    Url::create()->withPath('opensource/php')->getSegment(0);
})->expectException(InvalidArgument::class);

it('can return a path segment counting from behind', function () {
    $url = Url::create()->withPath('opensource/php');

    expect($url)->getSegment(-1)->toEqual('php');
});
