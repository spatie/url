<?php

use Spatie\Url\Url;

it('can check if it matches another url', function () {
    $url = Url::fromString('https://spatie.be');

    expect($url)->matches(Url::fromString('https://spatie.be/'))->toBeTrue();
});


it('can check if it doesnt match another url', function () {
    $url = Url::fromString('https://spatie.be');

    expect($url)->matches(Url::fromString('https://spatie.be/opensource'))->toBeFalse();
});


it('differentiates between urls with trailing slash', function () {
    $url = Url::fromString('https://spatie.be/opensource/');

    expect($url)->matches(Url::fromString('https://spatie.be/opensource'))->toBeFalse();
});


it('can check if it contains a mailto', function () {
    $url = Url::fromString('mailto:email@domain.tld');

    expect($url)->matches(Url::fromString('mailto:email@domain.tld'))->toBeTrue();
});


it('can check if it contains a tel', function () {
    $url = Url::fromString('tel:+3112345678');

    expect($url)->matches(Url::fromString('tel:+3112345678'))->toBeTrue();
});

it('can check if it contains a ws', function () {
    $url = Url::fromString('ws://localhost/ws');

    expect($url)->matches(Url::fromString('ws://localhost/ws'))->toBeTrue();
});
