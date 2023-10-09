<?php

namespace Deligoez\TCKimlikNo\Tests\Rules;

use Deligoez\TCKimlikNo\Rules\TCKimlikNoValidate;
use Deligoez\TCKimlikNo\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class TCKimlikNoValidateRuleTest extends TestCase
{
    /** @test */
    public function it_will_return_false_for_invalid_citizen_information(): void
    {
        Http::fake([
            'https://tckimlik.nvi.gov.tr/tcKimlikNoDogrula/search' => Http::response(['success' => false]),
        ]);

        $rule = new TCKimlikNoValidate('Yunus Emre', 'Deligöz', '1900', true, 1, 11);

        $this->assertFalse(
            $rule->passes('attribute', '10000000146')
        );
    }

    /** @test */
    public function it_will_return_true_for_valid_citizen_information(): void
    {
        Http::fake([
            'https://tckimlik.nvi.gov.tr/tcKimlikNoDogrula/search' => Http::response(['success' => true]),
        ]);

        $rule = new TCKimlikNoValidate('Yunus Emre', 'Deligöz', '1900', true, 1, 11);

        $this->assertTrue(
            $rule->passes('attribute', '10000000146')
        );
    }
}
