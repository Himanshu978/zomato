<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Review
 *
 * @package App\Facades
 */
class Review extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'review';
    }
}
