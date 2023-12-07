<?php

use Spatie\Url\SchemeValidator;
use Spatie\Url\Exceptions\InvalidArgument;
use Spatie\Url\Scheme;

it('can be instantiated', function () {
    $scheme = new Scheme();

    expect($scheme)->getScheme()->toEqual('');
    expect($scheme)->getAllowedSchemes()->toEqual(SchemeValidator::VALID_SCHEMES);
});

it('casts to a string', function () {
    $scheme = new Scheme();

    $scheme->setAllowedSchemes(['ws', 'wss']);
    $scheme->setScheme('wss');

    expect((string) $scheme)->toBe('wss');
});

it('sanitizes the scheme', function () {
    $scheme = new Scheme();

    $scheme->setScheme('HTTPS');

    expect($scheme)->getScheme()->toEqual('https');
});

it('validates by default allowed schemes when setting the scheme', function () {
    $scheme = new Scheme();

    $scheme->setScheme('https');

    expect($scheme)->not()->toThrow(InvalidArgument::class);
    expect($scheme)->getScheme()->toEqual('https');
});

it('doesnt validate by default allowed schemes when setting the scheme', function () {
    $scheme = new Scheme();

    $scheme->setScheme('xss');
})->throws(InvalidArgument::class, InvalidArgument::invalidScheme('xss', SchemeValidator::VALID_SCHEMES)->getMessage());

it('validates by custom allowed schemes when setting the scheme', function () {
    $scheme = new Scheme();

    $scheme->setAllowedSchemes(['ws', 'wss']);
    $scheme->setScheme('wss');

    expect($scheme)->not()->toThrow(InvalidArgument::class);
    expect($scheme)->getScheme()->toEqual('wss');
});

it('doesnt validate by custom allowed schemes when setting the scheme', function () {
    $scheme = new Scheme();

    $scheme->setAllowedSchemes(['ws', 'wss']);
    $scheme->setScheme('https');
})->throws(InvalidArgument::class, InvalidArgument::invalidScheme('https', ['ws', 'wss'])->getMessage());
