<?php

namespace Deligoez\TCKimlikNo\Tests\Provider;

use Deligoez\TCKimlikNo\Provider\TCKimlikNoFakerProvider;
use Deligoez\TCKimlikNo\Tests\TestCase;
use Faker\Factory;

class TCKimlikNoFakerProviderTest extends TestCase
{
    /** @test */
    public function it_can_generate_a_valid_tckn(): void
    {
        $faker = Factory::create();
        $faker->addProvider(new TCKimlikNoFakerProvider($faker));

        $this->assertEquals(11, strlen($faker->tckn));
    }
}
