<?php

namespace Deligoez\TCKimlikNo;

use SoapClient;

class TCKimlikNo
{
    /**
     * @param  string  $tcKimlikNo
     * @return bool
     */
    public static function verify(string $tcKimlikNo): bool
    {
        if (strlen(strval($tcKimlikNo)) != 11) {
            return false;
        }

        if (! preg_match('/^[1-9]{1}[0-9]{9}[0,2,4,6,8]{1}$/', $tcKimlikNo)) {
            return false;
        }

        $oddDigitsSum = $tcKimlikNo[0] + $tcKimlikNo[2] + $tcKimlikNo[4] + $tcKimlikNo[6] + $tcKimlikNo[8];
        $evenDigitsSum = $tcKimlikNo[1] + $tcKimlikNo[3] + $tcKimlikNo[5] + $tcKimlikNo[7];
        $digit10 = ($oddDigitsSum * 7 - $evenDigitsSum) % 10;
        $digit11 = ($oddDigitsSum + $evenDigitsSum + $tcKimlikNo[9]) % 10;

        if ($digit10 != $tcKimlikNo[9]) {
            return false;
        }

        if ($digit11 != $tcKimlikNo[10]) {
            return false;
        }

        return true;
    }
}
