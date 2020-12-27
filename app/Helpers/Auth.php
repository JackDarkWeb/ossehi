<?php


namespace App\Helpers;


class Auth
{

    /**
     * @param $name
     * @return mixed
     */
    protected static function resolveFacade($name){
        return app()[$name];
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        return (self::resolveFacade('Auth'))->$method(...$arguments);
    }

}
