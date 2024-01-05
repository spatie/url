<?php

use Spatie\Url\Exceptions\InvalidArgument;
use Spatie\Url\SchemeValidator;

it('can be instantiated', function () {
    $schemeValidator = new SchemeValidator();

    expect($schemeValidator)->getScheme()->toEqual(null);
    expect($schemeValidator)->getAllowedSchemes()->toEqual(SchemeValidator::VALID_SCHEMES);
});

it('can get and set the scheme', function () {
    $schemeValidator = new SchemeValidator();

    $schemeValidator->setScheme('https');

    expect($schemeValidator)->getScheme()->toEqual('https');
});

it('can get and set the allowed schemes', function () {
    $schemeValidator = new SchemeValidator();

    $schemeValidator->setAllowedSchemes(['wss']);

    expect($schemeValidator)->getAllowedSchemes()->toEqual(['wss']);
});

it('validates against the default allowed schemes', function () {
    $schemeValidator = new SchemeValidator();

    $schemeValidator->setScheme('https');

    expect($schemeValidator)->validate()->not()->toThrow(InvalidArgument::class);
});

it('does not validate against the default allowed schemes', function () {
    $schemeValidator = new SchemeValidator();

    $schemeValidator->setScheme('xss');

    expect($schemeValidator)->validate();
})->expectException(InvalidArgument::class);

it('validates against modified allowed schemes', function () {
    $schemeValidator = new SchemeValidator();

    $schemeValidator->setScheme('https');
    $schemeValidator->setAllowedSchemes(['ftp', 'https']);

    expect($schemeValidator)->validate()->not()->toThrow(InvalidArgument::class);
});

it('does not validate against modified allowed schemes', function () {
    $schemeValidator = new SchemeValidator();

    $schemeValidator->setScheme('xss');
    $schemeValidator->setAllowedSchemes(['ftp', 'https']);

    expect($schemeValidator)->validate();
})->expectException(InvalidArgument::class);
