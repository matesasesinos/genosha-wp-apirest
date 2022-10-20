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
define('GENOSHA_API_ENVIROMENT', api_get_enviroment() ? api_get_enviroment() : 'dev');
define('GENOSHA_ADMIN_ASSETS_IMAGES', plugin_dir_url( __FILE__ ).'/src/assets/images');

use Gen\Api\TestApi;
use Gen\Api\Includes\IncludesInit;
use Gen\Api\Endpoints\EndpointsInit;
use Gen\Api\Admin\AdminInit;

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
        //Protect routes
        add_filter('rest_authentication_errors', [__CLASS__,'protect_routes']);
        //Load plugin classes
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
        
        $enviroment = GENOSHA_API_ENVIROMENT;
        switch($enviroment) {
            case 'dev':
                $role = 'administrator';
                break;
            case 'prod':
                $role = 'subscriber';
                break;
        }

        if(!current_user_can($role)) {
            return new \WP_Error('rest_not_authorize', __('Your user is not enabled to see the resources', 'genosha-api'), ['status' => 401]);
        }

        return $result;
    }

    public static function load_classes()
    {
        TestApi::init();
        IncludesInit::init();
        EndpointsInit::init();
        AdminInit::init();
    }
}

GenoshaApiRestInit::init();