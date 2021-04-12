<?php

namespace Deligoez\TCKimlikNo\Tests;

use Deligoez\TCKimlikNo\TCKimlikNo;
use RicorocksDigitalAgency\Soap\Facades\Soap;
use RicorocksDigitalAgency\Soap\Response\Response;

class TCKimlikNoValidateTest extends TestCase
{
    /** @test */
    public function it_must_be_with_a_valid_citizen_number(): void
    {
        $this->assertFalse(
            TCKimlikNo::validate('not-valid', 'YUNUS EMRE', 'DELİGÖZ', '1900')
        );
    }

    /** @test */
    public function it_must_be_with_a_valid_name(): void
    {
        $this->assertFalse(
            TCKimlikNo::validate('10000000146', '0', 'DELİGÖZ', '1900')
        );

        $this->assertFalse(
            TCKimlikNo::validate('10000000146', '!', 'DELİGÖZ', '1900')
        );

        $this->assertFalse(
            TCKimlikNo::validate('10000000146', ' ', 'DELİGÖZ', '1900')
        );
    }

    /** @test */
    public function it_must_be_with_a_valid_surname(): void
    {
        $this->assertFalse(
            TCKimlikNo::validate('10000000146', 'YUNUS EMRE', '0', '1900')
        );

        $this->assertFalse(
            TCKimlikNo::validate('10000000146', 'YUNUS EMRE', '!', '1900')
        );

        $this->assertFalse(
            TCKimlikNo::validate('10000000146', 'YUNUS EMRE', ' ', '1900')
        );
    }

    /** @test */
    public function it_must_be_with_a_valid_birth_year(): void
    {
        $this->assertFalse(
            TCKimlikNo::validate('10000000146', 'YUNUS EMRE', 'DELİGÖZ', 'invalid-year')
        );

        $this->assertFalse(
            TCKimlikNo::validate('10000000146', 'YUNUS EMRE', 'DELİGÖZ', '0')
        );

        $this->assertFalse(
            TCKimlikNo::validate('10000000146', 'YUNUS EMRE', 'DELİGÖZ', '123')
        );

        $this->assertFalse(
            TCKimlikNo::validate('10000000146', 'YUNUS EMRE', 'DELİGÖZ', ' ')
        );
    }

    /** @test */
    public function dot_character_is_allowed_on_name(): void
    {
        Soap::fake([
            'https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL' => Response::new(['TCKimlikNoDogrulaResult' => true]),
        ]);

        $this->assertTrue(
            TCKimlikNo::validate('10000000146', 'Y. EMRE', 'DELİGÖZ', '1900')
        );
    }

    /** @test */
    public function dot_character_is_allowed_on_surname(): void
    {
        Soap::fake([
            'https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL' => Response::new(['TCKimlikNoDogrulaResult' => true]),
        ]);

        $this->assertTrue(
            TCKimlikNo::validate('10000000146', 'YUNUS EMRE', 'D. DELİGÖZ', '1900')
        );
    }
}
