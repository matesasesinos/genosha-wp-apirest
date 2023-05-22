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
        if (self::$init)
            return;
        self::$init = true;

        //add_filter('pll_copy_post_metas', [__CLASS__, 'copy_post_metas']);

        self::load_classes();
    }

    public static function load_classes()
    {
        ProjectsPostType::init();
        ServicesPostType::init();
        TeamPostType::init();
    }

    public static function copy_post_metas($metas)
    {
        return array_merge($metas, array('_genosha_project_content', '_genosha_service_content'));
    }
}
