<?php

namespace Gen\Api\Admin;

use Gen\Api\Admin\ConfOptions;
use Gen\Api\Admin\HelpOptions;

class AdminInit
{
    private static $init = false;
    public static function init()
    {
        if(self::$init)
            return;
        self::$init = true;

        add_action('admin_enqueue_scripts', [__CLASS__,'assets']);
        self::load_classes();
    }

    public static function assets()
    {
        wp_enqueue_style('api-admin-style', GENOSHA_ADMIN_ASSETS_CSS.'/admin.css', [], GENOSHA_API_VERSION);
        wp_enqueue_script('api-admin-script', GENOSHA_ADMIN_ASSETS_JS.'/admin.js', ['jquery'], GENOSHA_API_VERSION, true);
    }

    public static function load_classes()
    {
        ConfOptions::init();
        HelpOptions::init();
    }
}