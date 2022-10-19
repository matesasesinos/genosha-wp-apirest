<?php

namespace Gen\Api\Endpoints;

use Gen\Api\Endpoints\Projects;

class EndpointsInit
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
        Projects::init();
    }
}