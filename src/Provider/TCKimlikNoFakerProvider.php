<?php

namespace Deligoez\TCKimlikNo\Provider;

use Deligoez\TCKimlikNo\TCKimlikNo;
use Faker\Provider\Base;

class TCKimlikNoFakerProvider extends Base
{
    public static function tckn(): string
    {
        $randomDigits = static::regexify('/^[1-8]{2}[0-9]{7}$/');

        $checksumDigits = TCKimlikNo::generateChecksumDigits($randomDigits);

        return $randomDigits.$checksumDigits;
    }
}
