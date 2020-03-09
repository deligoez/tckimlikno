<?php

namespace Deligoez\TCKimlikNoDogrula\Tests;

use Deligoez\TCKimlikNo\TCKimlikNo;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class TCKimlikNoAutoUpperCaseTest extends TestCase
{
    protected $toUppercaseTrMethod;

    protected function setUp(): void
    {
        parent::setUp();

        $this->toUppercaseTrMethod = new ReflectionMethod(TCKimlikNo::class, 'toUppercaseTr');
        $this->toUppercaseTrMethod->setAccessible(true);
    }

    /** @test */
    public function it_uppercases_words(): void
    {
        $this->assertEquals(
            'YUNUS EMRE',
            $this->toUppercaseTrMethod->invoke(new TCKimlikNo(), 'yunus emre')
        );
    }

    /** @test */
    public function it_uppercases_turkish_specific_letters(): void
    {
        $this->assertEquals(
            'ÇĞIÖŞÜİ',
            $this->toUppercaseTrMethod->invoke(new TCKimlikNo(), 'çğıöşüi')
        );
    }

    /** @test */
    public function it_uppercases_turkish_specific_letters_with_circumflex(): void
    {
        $this->assertEquals(
            'ÂÊÎÔÛ',
            $this->toUppercaseTrMethod->invoke(new TCKimlikNo(), 'âêîôû')
        );
    }
}
