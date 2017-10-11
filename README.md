# Parse, build and manipulate URL's

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/url.svg?style=flat-square)](https://packagist.org/packages/spatie/url)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/url/master.svg?style=flat-square)](https://travis-ci.org/spatie/url)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/511cb04c-4420-4400-993d-5ba4ef55071f.svg?style=flat-square)](https://insight.sensiolabs.com/projects/511cb04c-4420-4400-993d-5ba4ef55071f)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/url.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/url)
[![StyleCI](https://styleci.io/repos/67992655/shield)](https://styleci.io/repos/67992655)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/url.svg?style=flat-square)](https://packagist.org/packages/spatie/url)

A simple package to deal with URL's in your applications.

Retrieve parts of the URL:

```php
$url = Url::fromString('https://spatie.be/opensource');

echo $url->getScheme(); // 'https'
echo $url->getHost(); // 'spatie.be'
echo $url->getPath(); // '/opensource'
```

Transform any part of the URL (the `Url` class is immutable):

```php
$url = Url::fromString('https://spatie.be/opensource');

echo $url->withHost('github.com')->withPath('spatie');
// 'https://github.com/spatie'
```

Retrieve and transform query parameters:

```php
$url = Url::fromString('https://spatie.be/opensource?utm_source=github&utm_campaign=pacakges');

echo $url->getQuery(); // 'utm_source=github&utm_campaign=pacakges'
echo $url->getQueryParameter('utm_source'); // 'github'
echo $url->withoutQueryParameter('utm_campaign'); // 'https://spatie.be/opensource?utm_source=github'
```

Retrieve path segments:

```php
$url = Url::fromString('https://spatie.be/opensource/laravel');

echo $url->getSegment(1); // 'opensource'
echo $url->getSegment(2); // 'laravel'
```

Implements PSR-7's `UriInterface` interface:

```php
class Url implements UriInterface { /* ... */ }
```

The [`league/uri`](https://github.com/thephpleague/uri) is a more powerful package than this one. The main reason this package exists, is because the alternatives requires non-standard php extensions. If you're dealing with special character encodings or need bulletproof validation, you're definitely better off using `league/uri`.

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Installation

You can install the package via composer:

``` bash
composer require spatie/url
```

## Usage

Usage is pretty straightforward. Check out the code examples at the top of this readme.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## Support us

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie). 
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
