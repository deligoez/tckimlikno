# TCKimlikNo

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Turkish Identification Number Verification & Validation Package for Laravel.

Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require deligoez/tckimlikno
```

## Usage

``` php
use Deligoez\TCKimlikNo\TCKimlikNo;


// Verifies Citizenship Number According to it's Algorithm.
// Returns Boolean
TCKimlikNo::verify('12345678901');

// Verifies Parameters and validates all using nvi.gov.tr API
// Returns Boolean
TCKimlikNo::validate('10000000146', 'YUNUS EMRE', 'DELİGÖZ', '1900') // uses nvi.gov
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email ye@deligoz.me instead of using the issue tracker.

## Credits

- [Yunus Emre Deligöz][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/deligoez/tckimlikno.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/deligoez/tckimlikno.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/deligoez/tckimlikno/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/193854934/shield

[link-packagist]: https://packagist.org/packages/deligoez/tckimlikno
[link-downloads]: https://packagist.org/packages/deligoez/tckimlikno
[link-travis]: https://travis-ci.org/deligoez/tckimlikno
[link-styleci]: https://styleci.io/repos/193854934
[link-author]: https://github.com/deligoez
[link-contributors]: ../../contributors
