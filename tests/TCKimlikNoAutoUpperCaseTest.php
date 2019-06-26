<?php

namespace Deligoez\TCKimlikNoDogrula\Tests;

use PHPUnit\Framework\TestCase;
use Deligoez\TCKimlikNo\TCKimlikNo;
use ReflectionMethod;

class TCKimlikNoAutoUpperCaseTest extends TestCase
{
    protected $toUppercaseTrMethod;

    protected function setUp()
    {
        parent::setUp();

        $this->toUppercaseTrMethod =  new ReflectionMethod(TCKimlikNo::class, 'toUppercaseTr');
        $this->toUppercaseTrMethod->setAccessible(true);

    }

    /** @test */
    public function it_uppercases_words()
    {
        $this->assertEquals(
            "YUNUS EMRE",
            $this->toUppercaseTrMethod->invoke(new TCKimlikNo(), 'yunus emre')
        );
    }

    /** @test */
    public function it_uppercases_turkish_specific_letters()
    {
        $this->assertEquals(
            "ÇĞIÖŞÜİ",
            $this->toUppercaseTrMethod->invoke(new TCKimlikNo(), 'çğıöşüi')
        );
    }

    /** @test */
    public function it_uppercases_turkish_specific_letters_with_circumflex()
    {
        $this->assertEquals(
            "ÂÊÎÔÛ",
            $this->toUppercaseTrMethod->invoke(new TCKimlikNo(), 'âêîôû')
        );
    }
}
