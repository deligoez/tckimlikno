<?php

namespace Deligoez\TCKimlikNo\Provider;

use Faker\Provider\Base;
use Deligoez\TCKimlikNo\TCKimlikNo;

class TCKimlikNoFakerProvider extends Base
{
    public static function tckn()
    {
        $randomDigits = static::regexify('/^[1-9]{1}[0-9]{8}$/');

        $checksumDigits = TCKimlikNo::generateChecksumDigits($randomDigits);

        return $randomDigits.$checksumDigits;
    }
}
