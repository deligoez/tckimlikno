# Changelog

All notable changes to `TCKimlikNo` will be documented in this file.

## [Unreleased]

## Version 5.0.0 - 2024-06-26
- Add Laravel V11 Support
- Add PHP 8.3 Support
- Add `guzzlehttp/guzzle` dependency at version ^7.2.0 for HTTP requests.
- Upgrade `phpunit/phpunit` to ^9.5 | ^10.5 for testing.

## Version 4.1.0 - 2023-10-09
- New search api by @aydinfatih in #26

## Version 4.0.0 - 2023-04-28
- Add Laravel V10 Support
- Drop PHP 7.4 and 8.0 support.
- Drop Laravel 6, 7, 8 support

## Version 3.2.0 - 2022-05-25
- Laravel 9 support by @frkcn in #20

## Version 3.1.0 - 2021-05-17
- Allow localization of error messages (Thanks to [@Mecit](https://github.com/Mecit))

## Version 3.0.0 - 2021-04-12
- Allow `.` character on name and surnames
- Use `ricorocks-digital-agency/soap` package for making/faking soap requests
- Set minimum PHP version to 7.4

## Version 2.1.0 - 2021-02-17

- PHP 8 Support (Thanks to [@taliptako](https://github.com/taliptako))
- Update composer dependencies
- Replace `fzaninotto/faker` package with `fakerphp/faker` package
- Small refactorings
- Remove Travis CI
- Run Tests on GitHub Workflows

## Version 2.0.0 - 2020-10-07

- Laravel 8 Support

## Version 1.5 - 2020-03-10

- Laravel 7 Support (Thanks to [@tkaratug](https://github.com/tkaratug))

## Version 1.4.1 - 2019-09-12

- Fix php negative mod confusion to generate random tckn's

## Version 1.4.0 - 2019-09-05

- Laravel 6 Support

## Version 1.3.0 - 2019-07-18

- Readme: Add usage information for Faker Provider
- Add TCKimlikNoFakerProvider
- Add TCKimlikNoFakerProviderTest
- TCKimlikNo: Add generateChecksumDigits() Method
- Don't generate Foreigner Identity Number
- Add fzaninotto/faker requirement

## Version 1.2.0 - 2019-06-27

- It can verify/validate both Integer and String Citizen IDs
- Add License Badge, Edit `.scrutinizer.yml for Code Coverage
- Add a Controller Validation Example for `TCKimlikNoVerify` Rule

## Version 1.1.1 - 2019-06-26

- Changed the minimum version `illuminate/support` as `^5.7` to use Laravel's `Rule` Class

## Version 1.1 - 2019-06-26

- `TCKimlikNoVerify` and `TCKimlikNoValidate` Laravel Validation Rules

## Version 1.0 - 2019-06-26

- Initial Release
