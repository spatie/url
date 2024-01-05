# Parse, build and manipulate URLs

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/url.svg?style=flat-square)](https://packagist.org/packages/spatie/url)
[![Tests](https://github.com/spatie/url/actions/workflows/run-tests.yml/badge.svg)](https://github.com/spatie/url/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/url.svg?style=flat-square)](https://packagist.org/packages/spatie/url)

A simple package to deal with URLs in your applications.

## Installation

You can install the package via composer:

```bash
composer require spatie/url
```

## Usage

### Parse and transform a URL

Retrieve any part of the URL:

```php
use Spatie\Url\Url;

$url = Url::fromString('https://spatie.be/opensource');

echo $url->getScheme(); // 'https'
echo $url->getHost(); // 'spatie.be'
echo $url->getPath(); // '/opensource'
```

Transform any part of the URL:

> **Note**
> the `Url` class is immutable.

```php
$url = Url::fromString('https://spatie.be/opensource');

echo $url->withHost('github.com')->withPath('spatie');
// 'https://github.com/spatie'
```

### Scheme

Transform the URL scheme.
```php
$url = Url::fromString('http://spatie.be/opensource');

echo $url->withScheme('https'); // 'https://spatie.be/opensource'
```

Use a list of allowed schemes.

> **Note**
> each scheme in the list will be sanitized

```php
$url = Url::fromString('https://spatie.be/opensource');

echo $url->withAllowedSchemes(['wss'])->withScheme('wss'); // 'wss://spatie.be/opensource'
```

or pass the list directly to `fromString` as the URL's scheme will be sanitized and validated immediately:

```php
$url = Url::fromString('https://spatie.be/opensource', [...SchemeValidator::VALID_SCHEMES, 'wss']);

echo $url->withScheme('wss'); // 'wss://spatie.be/opensource'
```


### Query parameters

Retrieve and transform query parameters:

```php
$url = Url::fromString('https://spatie.be/opensource?utm_source=github&utm_campaign=packages');

echo $url->getQuery(); // 'utm_source=github&utm_campaign=packages'

echo $url->getQueryParameter('utm_source'); // 'github'
echo $url->getQueryParameter('utm_medium'); // null
echo $url->getQueryParameter('utm_medium', 'social'); // 'social'
echo $url->getQueryParameter('utm_medium', function() {
    //some logic
    return 'email';
}); // 'email'

echo $url->withoutQueryParameter('utm_campaign'); // 'https://spatie.be/opensource?utm_source=github'
echo $url->withQueryParameters(['utm_campaign' => 'packages']); // 'https://spatie.be/opensource?utm_source=github&utm_campaign=packages'
```

### Path segments

Retrieve path segments:

```php
$url = Url::fromString('https://spatie.be/opensource/laravel');

echo $url->getSegment(1); // 'opensource'
echo $url->getSegment(2); // 'laravel'
```

### PSR-7 `UriInterface`

Implements PSR-7's `UriInterface` interface:

```php
class Url implements UriInterface { /* ... */ }
```

The [`league/uri`](https://github.com/thephpleague/uri) is a more powerful package than this one. The main reason this package exists, is because the alternatives requires non-standard php extensions. If you're dealing with special character encodings or need bulletproof validation, you're definitely better off using `league/uri`.

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Testing

```bash
composer test
```

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/url.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/url)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Kruikstraat 22, 2018 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
