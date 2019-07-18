<?php

namespace Deligoez\TCKimlikNo\Provider;

use Deligoez\TCKimlikNo\TCKimlikNo;
use Faker\Provider\Base;

class TCKimlikNoFakerProvider extends Base
{
    public static function tckn()
    {
        $randomDigits = static::regexify('/^[1-9]{1}[0-9]{8}$/');

        $checksumDigits = TCKimlikNo::generateChecksumDigits($randomDigits);

        return $randomDigits . $checksumDigits;
    }
}