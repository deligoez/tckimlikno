<?php

namespace Deligoez\TCKimlikNo\Tests;

use Deligoez\TCKimlikNo\TCKimlikNoServiceProvider;
use RicorocksDigitalAgency\Soap\Providers\SoapServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            TCKimlikNoServiceProvider::class,
            SoapServiceProvider::class
        ];
    }
}