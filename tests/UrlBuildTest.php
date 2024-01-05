<?php

use Spatie\Url\Exceptions\InvalidArgument;
use Spatie\Url\SchemeValidator;
use Spatie\Url\Url;

it('can build a url with a host', function () {
    $url = Url::create()->withHost('spatie.be');

    expect((string) $url)->toEqual('//spatie.be');
});


it('can build a url with a scheme', function () {
    $url = Url::create()
              ->withScheme('https')
              ->withHost('spatie.be');

    expect((string) $url)->toEqual('https://spatie.be');
});


it('can build a url with a mailto', function () {
    $url = Url::create()
              ->withScheme('mailto')
              ->withUserInfo('spatie')
              ->withPath('spatie.be');

    expect((string) $url)->not()->toEqual('mailto:spatie@/spatie.be');
    expect((string) $url)->toEqual('mailto:spatie@spatie.be');

    // @TODO Incorrect, but fixing conflicts with backward compatibility.
    expect($url)->getPath()->toEqual('/spatie.be');
});


it('can convert itself back to a string', function () {
    $url = Url::fromString('https://spatie.be/');

    expect((string) $url)->toEqual('https://spatie.be');
});


it('throws an exception when providing an invalid url scheme', function () {
    Url::create()->withScheme('htps');
})->throws(InvalidArgument::class, InvalidArgument::invalidScheme('htps', SchemeValidator::VALID_SCHEMES)->getMessage());


it('can build a url with a user', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withUserInfo('sebastian');

    expect((string) $url)->toEqual('//sebastian@spatie.be');
});


it('can build a url with a user and a password', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withUserInfo('sebastian', 'supersecret');

    expect((string) $url)->toEqual('//sebastian:supersecret@spatie.be');
});


it('can build a url with a port', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withPort(9000);

    expect((string) $url)->toEqual('//spatie.be:9000');
});


it('can build a url with a path', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withPath('/opensource');

    expect((string) $url)->toEqual('//spatie.be/opensource');
});


it('preserves a trailing slash in the path', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withPath('opensource/');

    expect((string) $url)->toEqual('//spatie.be/opensource/');
});


it('prefixes paths with a slash if its not present', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withPath('opensource');

    expect($url)->getPath()->toEqual('/opensource');
});


it('can build a url with a dirname', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withDirname('opensource');

    expect((string) $url)->toEqual('//spatie.be/opensource');
});


it('can build a url with a dirname and base name', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withBaseName('source')
              ->withDirname('opensource');

    expect((string) $url)->toEqual('//spatie.be/opensource/source');
});


it('can build a url is only with a base name', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withBaseName('source');

    expect((string) $url)->toEqual('//spatie.be/source');
});


it('can build a url with a basename', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withPath('/opensource/php')
              ->withBasename('laravel');

    expect((string) $url)->toEqual('//spatie.be/opensource/laravel');
});


it('can build a url with a query', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withQuery('utm_source=phpunit');

    expect((string) $url)->toEqual('//spatie.be?utm_source=phpunit');
});


it('can build a url with a fragment', function () {
    $url = Url::create()
              ->withHost('spatie.be')
              ->withFragment('bottom-of-page');

    expect((string) $url)->toEqual('//spatie.be#bottom-of-page');
});


it('can build a url with the full monty', function () {
    $url = Url::create()
              ->withScheme('https')
              ->withUserInfo('sebastian', 'supersecret')
              ->withHost('spatie.be')
              ->withPort(9000)
              ->withPath('/opensource')
              ->withQuery('utm_source=phpunit')
              ->withFragment('bottom-of-page');

    expect((string) $url)->toEqual('https://sebastian:supersecret@spatie.be:9000/opensource?utm_source=phpunit#bottom-of-page');
});


it('prefixes the path if the url has an authority but is rootless', function () {
    $url = Url::create()
              ->withUserInfo('sebastian', 'supersecret')
              ->withPort(9000)
              ->withPath('opensource');

    expect((string) $url)->toEqual('//sebastian:supersecret@:9000/opensource');
});
