<?php

namespace Deligoez\TCKimlikNoDogrula\Tests\Rules;

use Deligoez\TCKimlikNo\Rules\TCKimlikNoVerify;
use PHPUnit\Framework\TestCase;

class TCKimlikNoVerifyRuleTest extends TestCase
{
    /** @test */
    public function it_will_return_true_for_a_valid_citizen_number()
    {
        $rule = new TCKimlikNoVerify();

        $this->assertTrue(
            $rule->passes('attribute', '10000000146')
        );
    }

    /** @test */
    public function it_will_return_false_for_an_invalid_citizen_number()
    {
        $rule = new TCKimlikNoVerify();

        $this->assertFalse(
            $rule->passes('attribute', '10000000000')
        );
    }
}
