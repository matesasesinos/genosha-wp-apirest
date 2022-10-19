<?php

/**
 * Plugin Name: Genosha API REST
 * Version: 1.0.1
 * Author: Juan Iriart
 * Description: Genosha plugin for API REST v3
 */

require plugin_dir_path(__FILE__) . '/vendor/autoload.php';


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
    }
}

GenoshaApiRestInit::init();