<?php

namespace Deligoez\TCKimlikNoDogrula\Tests\Provider;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use Deligoez\TCKimlikNo\Provider\TCKimlikNoFakerProvider;

class TCKimlikNoFakerProviderTest extends TestCase
{
    /** @test */
    public function it_can_generate_a_valid_tckn()
    {
        $faker = Factory::create();
        $faker->addProvider(new TCKimlikNoFakerProvider($faker));

        $this->assertEquals(11, strlen($faker->tckn));
    }

    /** @test */
    public function it_can_generate_too_many_valid_tckns()
    {
        $this->markTestSkipped();

        $faker = Factory::create();
        $faker->addProvider(new TCKimlikNoFakerProvider($faker));

        for ($x = 0; $x <= 1000000; $x++) {
            $this->assertEquals(11, strlen($faker->tckn));
        }
    }
}
