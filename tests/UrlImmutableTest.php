<?php

use Spatie\Url\Url;

test('with scheme returns a new instance', function () {
    $url = Url::fromString('http://spatie.be');

    $clone = $url->withScheme('https');

    expect($url)->getScheme()->toEqual('http');
    expect($clone)->getScheme()->toEqual('https');
});


test('with user info returns a new instance', function () {
    $url = Url::fromString('https://spatie.be');

    $clone = $url->withUserInfo('sebastian', 'supersecret');

    expect($url)->getUserInfo()->toEqual('');
    expect($clone)->getUserInfo()->toEqual('sebastian:supersecret');
});


test('with host returns a new instance', function () {
    $url = Url::fromString('https://spatie.be');

    $clone = $url->withHost('sebastiandedeyne.com');

    expect($url)->getHost()->toEqual('spatie.be');
    expect($clone)->getHost()->toEqual('sebastiandedeyne.com');
});


test('with port returns a new instance', function () {
    $url = Url::fromString('https://spatie.be');

    $clone = $url->withPort(9000);

    expect($url)->getPort()->toBeNull();
    expect($clone)->getPort()->toEqual(9000);
});


test('with path returns a new instance', function () {
    $url = Url::fromString('https://spatie.be');

    $clone = $url->withPath('/opensource');

    expect($url)->getPath()->toEqual('/');
    expect($clone)->getPath()->toEqual('/opensource');
});


test('with query returns a new instance', function () {
    $url = Url::fromString('https://spatie.be');

    $clone = $url->withQuery('utm_source=phpunit');

    expect($url)->getQuery()->toEqual('');
    expect($clone)->getQuery()->toEqual('utm_source=phpunit');
});


test('with query parameter returns a new instance', function () {
    $url = Url::fromString('https://spatie.be');

    $clone = $url->withQueryParameter('utm_source', 'phpunit');

    expect($url)->getQuery()->toEqual('');
    expect($clone)->getQuery()->toEqual('utm_source=phpunit');
});


test('withput query parameter returns a new instance', function () {
    $url = Url::fromString('https://spatie.be')->withQueryParameter('utm_source', 'phpunit');

    $clone = $url->withoutQueryParameter('utm_source');

    expect($url)->getQuery()->toEqual('utm_source=phpunit');
    expect($clone)->getQuery()->toEqual('');
});


test('with fragment returns a new instance', function () {
    $url = Url::fromString('https://spatie.be');

    $clone = $url->withFragment('bottom-of-page');

    expect($url)->getFragment()->toEqual('');
    expect($clone)->getFragment()->toEqual('bottom-of-page');
});
