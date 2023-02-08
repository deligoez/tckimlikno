<?php

namespace Deligoez\YabanciKimlikNo;

use Deligoez\TCKimlikNo\Facades\TCKimlikNo;
use RicorocksDigitalAgency\Soap\Facades\Soap;

class YabanciKimlikNo
{
    /**
     * Validates Citizenship Number using nvi.gov.tr.
     *
     * @param  string  $kimlikNo
     * @param  string  $name
     * @param  string  $surname
     * @param  string  $birthYear
     * @param  string  $birthMonth
     * @param  string  $birthDay
     * @param  bool  $autoUppercase
     * @return bool
     *
     * @throws \SoapFault
     */
    public static function validate(
        $kimlikNo,
        string $name,
        string $surname,
        $birthYear,
        $birthMonth,
        $birthDay,
        bool $autoUppercase = true
    ): bool {
        if ($autoUppercase) {
            $name = TCKimlikNo::toUppercaseTr($name);
            $surname = TCKimlikNo::toUppercaseTr($surname);
        }

        if (! preg_match('/^[A-Z\. ÇĞÖŞÜİ]+$/u', TCKimlikNo::toUppercaseTr($name))) {
            return false;
        }

        if (! preg_match('/^[A-Z\. ÇĞÖŞÜİ]+$/u', TCKimlikNo::toUppercaseTr($surname))) {
            return false;
        }

        if (! preg_match('/^\d{4}$/', $birthYear)) {
            return false;
        }

        if (! preg_match('/^\d{2}$/', $birthMonth)) {
            return false;
        }

        if (! preg_match('/^\d{2}$/', $birthDay)) {
            return false;
        }

        if (! TCKimlikNo::verify($kimlikNo)) {
            return false;
        }

        $response = Soap::to('https://tckimlik.nvi.gov.tr/Service/KPSPublicYabanciDogrula.asmx?WSDL')
                        ->YabanciKimlikNoDogrula([
                            'KimlikNo' => (int) $kimlikNo,
                            'Ad'         => trim($name),
                            'Soyad'      => trim($surname),
                            'DogumGun'  => (int) $birthDay,
                            'DogumAy'  => (int) $birthMonth,
                            'DogumYil'  => (int) $birthYear,
                        ]);

        return (bool) $response->YabanciKimlikNoDogrulaResult;
    }
}
