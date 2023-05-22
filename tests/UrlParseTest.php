<?php

use Spatie\Url\Exceptions\InvalidArgument;
use Spatie\Url\Url;

it('can parse a scheme', function () {
    $url = Url::fromString('https://spatie.be');

    expect($url)->getScheme()->toEqual('https');
});


it('can parse a scheme that uses incorrect casing', function () {
    $url = Url::fromString('HTTPS://SPATIE.BE');

    expect($url)->getScheme()->toEqual('https');
});


it('can parse a scheme with mailto', function () {
    $url = Url::fromString('mailto:email@domain.tld');

    expect($url)->getScheme()->toEqual('mailto');
});


it('can parse a path with mailto', function () {
    $url = Url::fromString('mailto:email@domain.tld');

    expect($url)->getPath()->toEqual('email@domain.tld');
});


it('can parse a scheme with tel', function () {
    $url = Url::fromString('tel:+3112345678');

    expect($url)->getScheme()->toEqual('tel');
});


it('can parse a path with tel', function () {
    $url = Url::fromString('tel:+3112345678');

    expect($url)->getPath()->toEqual('+3112345678');
});

it('can parse a path with ws', function () {
    $url = Url::fromString('ws://localhost/ws');

    expect($url)->getPath()->toEqual('localhost');
});


it('throws an exception if an invalid scheme is provided', function () {
    Url::fromString('htps://spatie.be');
})->throws(InvalidArgument::class, InvalidArgument::invalidScheme('htps')->getMessage());


it('throws an exception if a totally invalid url is provided', function () {
    Url::fromString('///remote/fgt_lang?lang=/../../../..//////////dev/');
})->expectException(InvalidArgument::class);


it('can parse a host', function () {
    $url = Url::fromString('https://spatie.be');

    expect($url)->getHost()->toEqual('spatie.be');
});


it('can parse a path', function () {
    $url = Url::fromString('https://spatie.be/opensource');

    expect($url)->getPath()->toEqual('/opensource');
});


it('preserves a trailing slash in the path', function () {
    $url = Url::fromString('https://spatie.be/opensource/');

    expect($url)->getPath()->toEqual('/opensource/');
});


it('can parse an empty path', function () {
    $url = Url::fromString('https://spatie.be');

    expect($url)->getPath()->toEqual('/');
});


it('can parse a basename', function () {
    $url = Url::fromString('https://spatie.be/opensource/laravel');

    expect($url)->getBasename()->toEqual('laravel');
});


it('can parse a dirname', function () {
    $url = Url::fromString('https://spatie.be/opensource/laravel');

    expect($url)->getDirname()->toEqual('/opensource');
});


it('can parse a dirname if the dir is the root', function () {
    $url = Url::fromString('https://spatie.be/opensource');

    expect($url)->getDirname()->toEqual('/');
});


it('can parse a relative url', function () {
    $url = Url::fromString('/opensource');

    expect($url)->getPath()->toEqual('/opensource');
});


it('can parse a query', function () {
    $url = Url::fromString('https://spatie.be?utm_source=phpunit');

    expect($url)->getQuery()->toEqual('utm_source=phpunit');
});


it('can parse a fragment', function () {
    $url = Url::fromString('https://spatie.be#bottom-of-page');

    expect($url)->getFragment()->toEqual('bottom-of-page');
});


it('can parse user info', function () {
    $url = Url::fromString('https://sebastian:supersecret@spatie.be');

    expect($url)->getUserInfo()->toEqual('sebastian:supersecret');
});


it('can parse the authority', function () {
    $url = Url::fromString('https://sebastian:supersecret@spatie.be:9000/opensource');

    expect($url)->getAuthority()->toEqual('sebastian:supersecret@spatie.be:9000');
});
