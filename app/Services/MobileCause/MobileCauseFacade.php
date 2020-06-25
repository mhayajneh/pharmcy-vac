<?php

namespace App\Services\MobileCause;

use Illuminate\Support\Facades\Facade;

class MobileCauseFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mobilecause';
    }
}
