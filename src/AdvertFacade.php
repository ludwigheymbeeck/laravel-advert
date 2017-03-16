<?php
namespace LudwigHeymbeeck\LaravelAdvert;

use Illuminate\Support\Facades\Facade;

class AdvertFacade extends Facade
{
    /**
     * Name of the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'advert_manager';
    }
}
