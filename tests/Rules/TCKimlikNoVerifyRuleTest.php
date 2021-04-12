<?php

namespace Deligoez\TCKimlikNo\Tests\Rules;

use Deligoez\TCKimlikNo\Tests\TestCase;
use Deligoez\TCKimlikNo\Rules\TCKimlikNoVerify;

class TCKimlikNoVerifyRuleTest extends TestCase
{
    /** @test */
    public function it_will_return_true_for_a_valid_citizen_number(): void
    {
        $rule = new TCKimlikNoVerify();

        $this->assertTrue(
            $rule->passes('attribute', '10000000146')
        );
    }

    /** @test */
    public function it_will_return_false_for_an_invalid_citizen_number(): void
    {
        $rule = new TCKimlikNoVerify();

        $this->assertFalse(
            $rule->passes('attribute', '10000000000')
        );
    }
}
