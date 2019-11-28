<?php

namespace Deligoez\TCKimlikNo\Provider;

use Faker\Provider\Base;
use Deligoez\TCKimlikNo\TCKimlikNo;

class TCKimlikNoFakerProvider extends Base
{
    public static function tckn(): string
    {
        $randomDigits = static::regexify('/^[1-8]{2}[0-9]{7}$/');

        $checksumDigits = TCKimlikNo::generateChecksumDigits($randomDigits);

        return $randomDigits.$checksumDigits;
    }
}
