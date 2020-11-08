<?php


namespace biscuit\package\facades;


use Illuminate\Support\Facades\Facade;

class Press extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Press';
    }
}