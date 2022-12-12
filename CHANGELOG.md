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
