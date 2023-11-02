# [3.5.0](https://github.com/tenantcloud/php-trans-union-sdk/compare/v3.4.1...v3.5.0) (2023-11-02)


### Features

* Find request renter method ([#19](https://github.com/tenantcloud/php-trans-union-sdk/issues/19)) ([bf8384c](https://github.com/tenantcloud/php-trans-union-sdk/commit/bf8384cb0c5a5ef286b6c1a5d855653dd7f4087f))

## [3.4.1](https://github.com/tenantcloud/php-trans-union-sdk/compare/v3.4.0...v3.4.1) (2023-07-05)


### Bug Fixes

* Allow Laravel 10.x ([#18](https://github.com/tenantcloud/php-trans-union-sdk/issues/18)) ([c794c65](https://github.com/tenantcloud/php-trans-union-sdk/commit/c794c65a07806bb0902a7e02b5a0ba630df33132))

# [3.3.0](https://github.com/tenantcloud/php-trans-union-sdk/compare/v3.2.0...v3.3.0) (2023-06-01)


### Features

* Better Income Insights fake ([#16](https://github.com/tenantcloud/php-trans-union-sdk/issues/16)) ([38714b6](https://github.com/tenantcloud/php-trans-union-sdk/commit/38714b6bd4e54d8a91a24c4b483fe3efcb5edf97))

# [3.2.0](https://github.com/tenantcloud/php-trans-union-sdk/compare/v3.1.2...v3.2.0) (2023-05-30)


### Features

* Income Insights ([#15](https://github.com/tenantcloud/php-trans-union-sdk/issues/15)) ([60b57ea](https://github.com/tenantcloud/php-trans-union-sdk/commit/60b57ead40908d407c064621b959cda46d87d6c8))

## [3.1.2](https://github.com/tenantcloud/php-trans-union-sdk/compare/v3.1.1...v3.1.2) (2023-03-28)


### Bug Fixes

* Some dates parsed as null when they shouldn't ([#14](https://github.com/tenantcloud/php-trans-union-sdk/issues/14)) ([0d31be1](https://github.com/tenantcloud/php-trans-union-sdk/commit/0d31be1d6097eb8529d8b6e70b59956ff351a8b8))

## [3.1.1](https://github.com/tenantcloud/php-trans-union-sdk/compare/v3.1.0...v3.1.1) (2023-03-27)


### Bug Fixes

* Unable to parse some hidden dates ([#13](https://github.com/tenantcloud/php-trans-union-sdk/issues/13)) ([6d25147](https://github.com/tenantcloud/php-trans-union-sdk/commit/6d251479c1c3143980d2391945087a92ebf77239))

# [3.1.0](https://github.com/tenantcloud/php-trans-union-sdk/compare/v3.0.0...v3.1.0) (2023-03-22)


### Features

* New endpoint methods ([#12](https://github.com/tenantcloud/php-trans-union-sdk/issues/12)) ([c6ceba0](https://github.com/tenantcloud/php-trans-union-sdk/commit/c6ceba0974df5586ce145326ed5ebc431a48afb9))

# [3.0.0](https://github.com/tenantcloud/php-trans-union-sdk/compare/v2.0.0...v3.0.0) (2023-03-17)


### Bug Fixes

* PHPStan failing on master ([#10](https://github.com/tenantcloud/php-trans-union-sdk/issues/10)) ([72986ac](https://github.com/tenantcloud/php-trans-union-sdk/commit/72986ac0261543ffc623bd1bea2dc2f9588ad8af))
* Release failing ([#11](https://github.com/tenantcloud/php-trans-union-sdk/issues/11)) ([530f688](https://github.com/tenantcloud/php-trans-union-sdk/commit/530f6883c2404b4f02af52aafda91fbaaeffd504))


### Code Refactoring

* Report dates in UTC ([#9](https://github.com/tenantcloud/php-trans-union-sdk/issues/9)) ([159e369](https://github.com/tenantcloud/php-trans-union-sdk/commit/159e3691b0274726d65b7afcd3bbede1a227d893))


### BREAKING CHANGES

* All dates are now serialized in ISO8601

* fix: Make local dates have 12:00:00 hours to convert them in TZs

* fix: Make local dates have 12:00:00 hours to convert them in TZs

* fix: Make local dates have 12:00:00 hours to convert them in TZs

# 1.0.0 (2022-12-12)


### Bug Fixes

* Auto-transliterate diacritics in addresses ([#3](https://github.com/tenantcloud/php-trans-union-sdk/issues/3)) ([8b1f8f5](https://github.com/tenantcloud/php-trans-union-sdk/commit/8b1f8f5862fc481a356d5d9b344e43203d6bc912))
* Deserialization of some real-world reports ([#4](https://github.com/tenantcloud/php-trans-union-sdk/issues/4)) ([d5627a8](https://github.com/tenantcloud/php-trans-union-sdk/commit/d5627a82000547c40927370cddd8518d754240c9))
* Replace slashes in address because TU doesn't support them ([#6](https://github.com/tenantcloud/php-trans-union-sdk/issues/6)) ([bca0a14](https://github.com/tenantcloud/php-trans-union-sdk/commit/bca0a14e21fd94e45f901f9aa511c6652a19ea1c))


### Features

* Consistent mocks ([#8](https://github.com/tenantcloud/php-trans-union-sdk/issues/8)) ([bbaacf9](https://github.com/tenantcloud/php-trans-union-sdk/commit/bbaacf971bd8bd80172d1636e69c89933d34a751))
* Laravel 9 support ([b40c915](https://github.com/tenantcloud/php-trans-union-sdk/commit/b40c9152c23bf026aecb9549df746d18c059dc26))


### BREAKING CHANGES

* PHP 8.1 required

* refactor: Move & update tooling, require PHP 8.1

* feature: Consistent mocks

* fix: Cyclic dependency

* refactor: PHP 8.1 modernization

* fix: GitHub workflows broken after refactor

* fix: Use stable php-standard

* fix: Broken second verification TU mock

* refactor: Add readonly modifier
