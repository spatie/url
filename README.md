# Parse, build and manipulate URL's

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/url.svg?style=flat-square)](https://packagist.org/packages/spatie/url)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
![run-tests](https://github.com/spatie/url/workflows/run-tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/url.svg?style=flat-square)](https://packagist.org/packages/spatie/url)

A simple package to deal with URL's in your applications.

Retrieve parts of the URL:

```php
use Spatie\Url\Url;

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
$url = Url::fromString('https://spatie.be/opensource?utm_source=github&utm_campaign=packages');

echo $url->getQuery(); // 'utm_source=github&utm_campaign=packages'
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

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/url.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/url)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

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
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Kruikstraat 22, 2018 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
