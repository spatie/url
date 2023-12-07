<?php

use Spatie\Url\Url;
use Spatie\Url\Exceptions\InvalidArgument;

it('always allows an empty scheme against default scheme validator', function () {

    $url = Url::fromString('spatie.be');

    expect($url)->not()->toThrow(InvalidArgument::class);
    expect($url)->getScheme()->toEqual('');
});

it('allows a scheme against the default scheme validator', function () {

    $url = Url::fromString('https://spatie.be');

    expect($url)->toEqual('https://spatie.be');
    expect($url)->getScheme()->toEqual('https');
});

it('does not allow a scheme against the default scheme validator', function () {

    Url::fromString('wss://spatie.be');
})->throws(InvalidArgument::class);

it('always allows an empty scheme against configured allowed schemes', function () {

    $url = Url::fromString('websocket.io', ['ws', 'wss']);

    expect($url)->not()->toThrow(InvalidArgument::class);
});

it('allows a scheme against configured allowed schemes', function () {

    $url = Url::fromString('wss://websocket.io', ['ws', 'wss']);

    expect($url)->toEqual('wss://websocket.io');
    expect($url)->getScheme()->toEqual('wss');
});

it('allows a scheme against swapped allowed schemes', function () {

    $url = Url::fromString('https://spatie.be')
        ->withAllowedSchemes(['wss'])
        ->withScheme('wss');

    expect($url)->toEqual('wss://spatie.be');
    expect($url)->getScheme()->toEqual('wss');
});

it('does not allow a scheme against configured allowed schemes', function () {

    Url::fromString('xss://websocket.io', ['ws', 'wss']);
})->throws(InvalidArgument::class);
