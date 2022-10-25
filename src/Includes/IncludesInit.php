<?php

namespace Gen\Api\Includes;

use Gen\Api\Includes\ProjectsPostType;
use Gen\Api\Includes\ServicesPostType;
use Gen\Api\Includes\TeamPostType;

class IncludesInit
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
        ProjectsPostType::init();
        ServicesPostType::init();
        TeamPostType::init();
    }
}