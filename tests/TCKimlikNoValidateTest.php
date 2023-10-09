<?php

namespace Deligoez\TCKimlikNo\Tests;

use Deligoez\TCKimlikNo\Rules\TCKimlikNoValidate;
use Deligoez\TCKimlikNo\TCKimlikNo;
use Illuminate\Support\Facades\Http;
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
    public function it_sends_a_request_to_the_public_api_if_there_is_no_birth_year_and_day(): void
    {
        Http::fake();
        Soap::fake([
            'https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL' => Response::new(['TCKimlikNoDogrulaResult' => true]),
        ]);

        $this->assertTrue(
            TCKimlikNo::validate('10000000146', 'Y. EMRE', 'DELİGÖZ', '1900')
        );

        Http::assertNothingSent();
    }

    /** @test */
    public function it_sends_a_request_to_the_search_api_if_there_is_a_birth_year_and_day(): void
    {
        Http::fake([
            'https://tckimlik.nvi.gov.tr/tcKimlikNoDogrula/search' => Http::response(['success' => true]),
        ]);

        Soap::fake();

        $this->assertTrue(
            TCKimlikNo::validate('10000000146', 'Y. EMRE', 'DELİGÖZ', '1900', true, 1, 1)
        );

        Soap::assertNothingSent();
    }

    /** @test */
    public function it_sends_a_request_to_the_public_api_if_forced_to_public_api(): void
    {
        Http::fake();
        Soap::fake([
            'https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL' => Response::new(['TCKimlikNoDogrulaResult' => true]),
        ]);

        $this->assertTrue(
            TCKimlikNo::validate('10000000146', 'Y. EMRE', 'DELİGÖZ', '1900', true, 1, 1, true)
        );

        Http::assertNothingSent();
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

    /** @test */
    public function it_displays_the_translated_error_message()
    {
        $rule = new TCKimlikNoValidate('10000000146', 'YUNUS EMRE', 'DELİGÖZ', ' ');

        $this->assertFalse($rule->passes('field', '10000000146'));

        $this->assertSame('The :attribute field must be a valid Turkish Citizen Number.', $rule->message());

        $this->app->setLocale('tr');

        $this->assertSame(':attribute alanı geçerli bir T.C. Kimlik Numarası olmalıdır.', $rule->message());
    }
}
