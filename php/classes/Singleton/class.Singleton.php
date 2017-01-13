<?php

/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-12-2014
 * Time: 00:15
 */

/**
 * http://stackoverflow.com/questions/3126130/extending-singletons-in-php
 */
abstract class Singleton
{

    final public static function getInstance()
    {
        static $instances = array();

        // get_called_class() is only in PHP >= 5.3.
        if (!function_exists('get_called_class')) {

            function get_called_class()
            {
                $bt = debug_backtrace();
                $l = 0;
                do {
                    $l++;
                    $lines = file($bt[$l]['file']);
                    $callerLine = $lines[$bt[$l]['line'] - 1];
                    preg_match('/([a-zA-Z0-9\_]+)::' . $bt[$l]['function'] . '/', $callerLine, $matches);
                } while ($matches[1] === 'parent' && $matches[1]);

                return $matches[1];
            }
        }

        $calledClass = get_called_class();

        if (!isset($instances[$calledClass])) {
            $instances[$calledClass] = new $calledClass();
        }

        return $instances[$calledClass];

    }
}