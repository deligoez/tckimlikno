<?php

namespace Deligoez\TCKimlikNoDogrula\Tests\Rules;

use PHPUnit\Framework\TestCase;
use Deligoez\TCKimlikNo\Rules\TCKimlikNoValidate;

class TCKimlikNoValidateRuleTest extends TestCase
{
    /** @test */
    public function it_will_return_false_for_invalid_citizen_information(): void
    {
        $rule = new TCKimlikNoValidate('Yunus Emre', 'Deligöz', '1900');

        $this->assertFalse(
            $rule->passes('attribute', '10000000146')
        );
    }
}
