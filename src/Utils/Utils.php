<?php

namespace Gen\Api\Utils;

class Utils
{
    private static $init = false;
    public static function init()
    {
        if(self::$init)
            return;
        self::$init = true;

        self::load_classes();
    }

    public static function load_classes()
    {
       // A class init here
    }
}
