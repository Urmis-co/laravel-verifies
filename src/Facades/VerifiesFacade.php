<?php

namespace Urmis\Verifies\Facades;

use Illuminate\Support\Facades\Facade;

class VerifiesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'verifies';
    }
}