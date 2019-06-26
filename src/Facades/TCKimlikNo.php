<?php

namespace Deligoez\TCKimlikNo\Facades;

use Illuminate\Support\Facades\Facade;

class TCKimlikNo extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tckimlikno';
    }
}
