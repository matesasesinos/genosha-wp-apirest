<?php

/**
 * Plugin Name: Genosha API REST
 * Version: 1.0.1
 * Author: Juan Iriart
 * Description: Genosha plugin for API REST v3
 * Text Domain: genosha-api
 */

require plugin_dir_path(__FILE__) . '/vendor/autoload.php';

//Check if polylang exists

if (!in_array('polylang/polylang.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    function pl_admin_notice__error()
    {
?>
        <div class="notice notice-error is-dismissible">
            <p>Debes instalar <a href="https://es.wordpress.org/plugins/polylang/" target="_blank">Polylang</a> para las traducciones</p>
        </div>
<?php
    }
    add_action('admin_notices', 'pl_admin_notice__error');
}

define('GENOSHA_API_VERSION', '3.0.1');
define('GENOSHA_API_NAMESPACE', 'genosha/v3');
define('API_GET', \WP_REST_Server::READABLE);
define('GENOSHA_API_ENVIROMENT', function_exists('api_get_enviroment') && api_get_enviroment() ? api_get_enviroment() : 'dev');
define('GENOSHA_ADMIN_ASSETS_IMAGES', plugin_dir_url(__FILE__) . '/src/assets/images');
define('GENOSHA_ADMIN_ASSETS_CSS', plugin_dir_url(__FILE__) . '/src/assets/css');
define('GENOSHA_ADMIN_ASSETS_JS', plugin_dir_url(__FILE__) . '/src/assets/js');

use Gen\Api\TestApi;
use Gen\Api\Includes\IncludesInit;
use Gen\Api\Endpoints\EndpointsInit;
use Gen\Api\Admin\AdminInit;
use Gen\Api\Utils\Utils;

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
        add_filter('rest_authentication_errors', [__CLASS__, 'protect_routes']);
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
        switch ($enviroment) {
            case 'dev':
                $role = 'administrator';
                break;
            case 'prod':
                $role = 'subscriber';
                break;
        }

        if (!current_user_can($role)) {
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
        Utils::init();
    }
}

GenoshaApiRestInit::init();
