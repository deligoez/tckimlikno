<?php

namespace Deligoez\TCKimlikNoDogrula\Tests;

use PHPUnit\Framework\TestCase;
use Deligoez\TCKimlikNo\TCKimlikNo;

class TCKimlikNoTest extends TestCase
{
    /** @test */
    public function it_returns_false_for_more_than_11_digits()
    {
        $this->assertFalse(
            TCKimlikNo::verify('123456789012')
        );
    }

    /** @test */
    public function it_returns_false_when_number_begins_with_0()
    {
        $this->assertFalse(
            TCKimlikNo::verify('02345678901')
        );
    }

    /** @test */
    public function it_returns_false_when_last_digit_is_odd()
    {
        $this->assertFalse(
            TCKimlikNo::verify('12345678901')
        );

        $this->assertFalse(
            TCKimlikNo::verify('12345678903')
        );

        $this->assertFalse(
            TCKimlikNo::verify('12345678905')
        );

        $this->assertFalse(
            TCKimlikNo::verify('12345678907')
        );

        $this->assertFalse(
            TCKimlikNo::verify('12345678909')
        );
    }

    /** @test */
    public function tenth_digit_must_be_mod_10_of_sum_of_odd_digits_multiplied_by_7_minus_even_digits()
    {
        $this->assertFalse(
            TCKimlikNo::verify('11000000146')
        );

        $this->assertTrue(
            TCKimlikNo::verify('10000000146')
        );
    }
    
    /** @test */ 
    public function eleventh_digit_must_be_mod_10_of_sum_of_all_digits_plus_10th_digit()
    {
        $this->assertFalse(
            TCKimlikNo::verify('11000000144')
        );

        $this->assertTrue(
            TCKimlikNo::verify('10000000146')
        );
    }
}
