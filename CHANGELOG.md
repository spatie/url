# Changelog

All Notable changes to `url` will be documented in this file

## 2.2.1 - 2023-04-27

### What's Changed

- psr/http-message 2.0 compatibility by @misantron in https://github.com/spatie/url/pull/65

### New Contributors

- @misantron made their first contribution in https://github.com/spatie/url/pull/65

**Full Changelog**: https://github.com/spatie/url/compare/2.2.0...2.2.1

## 2.2.0 - 2022-12-14

### What's Changed

- Update .gitattributes by @angeljqv in https://github.com/spatie/url/pull/58
- Normalize composer.json by @patinthehat in https://github.com/spatie/url/pull/59
- Add PHP 8.2 Support by @patinthehat in https://github.com/spatie/url/pull/60
- lazy evaluate Url::getQueryParameter default argument by @bryanlopezinc in https://github.com/spatie/url/pull/61

### New Contributors

- @angeljqv made their first contribution in https://github.com/spatie/url/pull/58
- @bryanlopezinc made their first contribution in https://github.com/spatie/url/pull/61

**Full Changelog**: https://github.com/spatie/url/compare/2.1.1...2.2.0

## 2.1.1 - 2022-07-29

### What's Changed

- Rewrite tests using pest by @bvtterfly in https://github.com/spatie/url/pull/54
- Add withoutQueryParameters & unsetAll method by @MatusBoa in https://github.com/spatie/url/pull/56

### New Contributors

- @bvtterfly made their first contribution in https://github.com/spatie/url/pull/54
- @MatusBoa made their first contribution in https://github.com/spatie/url/pull/56

**Full Changelog**: https://github.com/spatie/url/compare/2.1.0...2.1.1

## 2.1.0 - 2022-03-28

## What's Changed

- Add support for tel: links by @mrk-j in https://github.com/spatie/url/pull/53

## New Contributors

- @mrk-j made their first contribution in https://github.com/spatie/url/pull/53

**Full Changelog**: https://github.com/spatie/url/compare/2.0.5...2.1.0

## 2.0.5 - 2022-02-16

## What's Changed

- Add support for array query parameters by @rapkis in https://github.com/spatie/url/pull/52

**Full Changelog**: https://github.com/spatie/url/compare/2.0.4...2.0.5

## 2.0.4 - 2022-02-03

## What's Changed

- Add ability to set multiple query parameters at once by @rapkis in https://github.com/spatie/url/pull/51

## New Contributors

- @rapkis made their first contribution in https://github.com/spatie/url/pull/51

**Full Changelog**: https://github.com/spatie/url/compare/2.0.3...2.0.4

## 2.0.3 - 2021-12-29

## What's Changed

- PHP 8.1 Compatibility by @MaSpeng in https://github.com/spatie/url/pull/49

## New Contributors

- @MaSpeng made their first contribution in https://github.com/spatie/url/pull/49

**Full Changelog**: https://github.com/spatie/url/compare/2.0.2...2.0.3

## 2.0.2 - 2021-11-17

## What's Changed

- Fix creating urls from invalid strings by @SamuelNitsche in https://github.com/spatie/url/pull/48

## New Contributors

- @SamuelNitsche made their first contribution in https://github.com/spatie/url/pull/48

**Full Changelog**: https://github.com/spatie/url/compare/2.0.1...2.0.2

## 2.0.1 - 2021-06-24

- remove prefixing `/` for `mailto:` schemes when building `withPath()`

## 2.0.0 - 2021-03-31

- require PHP 8+
- drop support for PHP 7.x
- use PHP 8 syntax where possible

## 1.3.5 - 2020-11-05

- update deps

## 1.3.4 - 2020-11-04

- support PHP 8

## 1.3.3 - 2020-08-31

- urlencode() new query params values (#35)

## 1.3.2 - 2020-02-19

- Updated: preserve trailing slash in URL path (#33)

## 1.3.0 - 2018-02-01

- Added: support for simple `mailto:` links

## 1.2.0 - 2017-09-18

- Added: `Url` now is macroable

## 1.1.0 - 2017-07-01

- Added: `getFirstSegment` and `getLastSegment`

## 1.0.2 - 2017-03-09

- Fixed: allow valuesless query parameters, e.g. `?foo=bar&amp;baz`

## 1.0.1 - 2016-11-14

- Fixed: Ensure an url does not end with `/`

## 1.0.0 - 2016-10-07

- First release
