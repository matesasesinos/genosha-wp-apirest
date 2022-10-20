<?php

namespace Gen\Api\Admin;

use Gen\Api\Admin\ConfOptions;

class AdminInit
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
        ConfOptions::init();
    }
}