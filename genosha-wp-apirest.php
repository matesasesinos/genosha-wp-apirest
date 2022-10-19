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
define('API_GET', \WP_REST_Server::READABLE);

use Gen\Api\TestApi;
use Gen\Api\Includes\IncludesInit;
use Gen\Api\Endpoints\EndpointsInit;

class GenoshaApiRestInit
{
    private static $init = false;
    public static function init()
    {
        if (self::$init)
            return;

        self::$init = true;
        //Initialize APP Passwords
        add_filter('wp_is_application_passwords_available', '__return_true');
        add_filter('rest_authentication_errors', [__CLASS__,'protect_routes']);
        self::load_classes();
    }

    public static function protect_routes($result)
    {
        if (!empty($result)) {
            return $result;
        }

        if (!is_user_logged_in()) {
            return new \WP_Error('rest_not_logged_in', __('You must logged for view the data', 'genosha-api'), ['status' => 403]);
        }

        if(!current_user_can('administrator')) {
            return new \WP_Error('rest_not_authorize', __('Your user is not enabled to see the resources', 'genosha-api'), ['status' => 401]);
        }

        return $result;
    }

    public static function load_classes()
    {
        TestApi::init();
        IncludesInit::init();
        EndpointsInit::init();
    }
}

GenoshaApiRestInit::init();