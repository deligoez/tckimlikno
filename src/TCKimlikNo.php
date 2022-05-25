<?php

namespace Deligoez\TCKimlikNo;

use RicorocksDigitalAgency\Soap\Facades\Soap;

class TCKimlikNo
{
    /**
     * Validates Citizenship Number using nvi.gov.tr.
     *
     * @param  string  $tcKimlikNo
     * @param  string  $name
     * @param  string  $surname
     * @param  string  $birthYear
     * @param  bool  $autoUppercase
     * @return bool
     *
     * @throws \SoapFault
     */
    public static function validate(
        $tcKimlikNo,
        string $name,
        string $surname,
        $birthYear,
        bool $autoUppercase = true
    ): bool {
        if ($autoUppercase) {
            $name = self::toUppercaseTr($name);
            $surname = self::toUppercaseTr($surname);
        }

        if (! preg_match('/^[A-Z\. ÇĞÖŞÜİ]+$/u', self::toUppercaseTr($name))) {
            return false;
        }

        if (! preg_match('/^[A-Z\. ÇĞÖŞÜİ]+$/u', self::toUppercaseTr($surname))) {
            return false;
        }

        if (! preg_match('/^\d{4}$/', $birthYear)) {
            return false;
        }

        if (! self::verify($tcKimlikNo)) {
            return false;
        }

        $response = Soap::to('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL')
                        ->TCKimlikNoDogrula([
                            'TCKimlikNo' => (int) $tcKimlikNo,
                            'Ad'         => trim($name),
                            'Soyad'      => trim($surname),
                            'DogumYili'  => (int) $birthYear,
                        ]);

        return (bool) $response->TCKimlikNoDogrulaResult;
    }

    /**
     * Prepares, trims, and makes uppercase names.
     *
     * @param $name
     * @return bool|false|mixed|string|string[]|null
     */
    private static function toUppercaseTr(string $name): string
    {
        return mb_strtoupper(
            str_replace(
                ['ç', 'ğ', 'ı', 'ö', 'ş', 'ü', 'i'],
                ['Ç', 'Ğ', 'I', 'Ö', 'Ş', 'Ü', 'İ'],
                $name
            )
        );
    }

    /**
     * Verify Citizenship Number According to it's Algorithm.
     *
     * @param  string  $tcKimlikNo
     * @return bool
     */
    public static function verify($tcKimlikNo): bool
    {
        $tcKimlikNo = (string) $tcKimlikNo;

        if (strlen((string) $tcKimlikNo) !== 11) {
            return false;
        }

        if (! preg_match('/^[1-9]{1}[0-9]{9}[0,2,4,6,8]{1}$/', $tcKimlikNo)) {
            return false;
        }

        $checksumDigits = static::generateChecksumDigits($tcKimlikNo);

        if ($checksumDigits[0] !== $tcKimlikNo[9]) {
            return false;
        }

        if ($checksumDigits[1] !== $tcKimlikNo[10]) {
            return false;
        }

        return true;
    }

    /**
     * Generates Checksum Digits from the first 9 Digits.
     *
     * @param $tcKimlikNo
     * @return string
     */
    public static function generateChecksumDigits($tcKimlikNo): string
    {
        $oddDigitsSum = $tcKimlikNo[0] + $tcKimlikNo[2] + $tcKimlikNo[4] + $tcKimlikNo[6] + $tcKimlikNo[8];
        $evenDigitsSum = $tcKimlikNo[1] + $tcKimlikNo[3] + $tcKimlikNo[5] + $tcKimlikNo[7];

        $digit10 = ($oddDigitsSum * 7 - $evenDigitsSum) % 10;
        $digit11 = ($oddDigitsSum + $evenDigitsSum + $digit10) % 10;

        if ($digit10 < 0) {
            $digit10 += 10;
        }

        return $digit10.$digit11;
    }
}
