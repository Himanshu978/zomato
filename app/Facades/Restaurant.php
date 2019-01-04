<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Restaurant
 *
 * @package App\Facades
 */
class Restaurant extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'restaurant';
    }
}
