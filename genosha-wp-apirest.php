<?php

/**
 * Plugin Name: Genosha API REST
 * Version: 1.0.1
 * Author: Juan Iriart
 * Description: Genosha plugin for API REST v3
 * Text Domain: genosha-api
 */

require plugin_dir_path(__FILE__) . '/vendor/autoload.php';

define('GENOSHA_API_NAMESPACE', 'genosha/v3');

use Gen\Api\TestApi;
use Gen\Api\Includes\IncludesInit;

class GenoshaApiRestInit
{
    private static $init = false;
    public static function init()
    {
        if(self::$init) 
            return;
        
        self::$init = true;
        //Initialize APP Passwords
        add_filter( 'wp_is_application_passwords_available', '__return_true' );

        self::load_classes();
    }

    public static function load_classes()
    {
        TestApi::init();
        IncludesInit::init();
    }
}

GenoshaApiRestInit::init();