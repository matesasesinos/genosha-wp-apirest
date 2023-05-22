<?php

/**
 * Plugin Name: Genosha API REST
 * Version: 1.0.4
 * Author: Juan Iriart
 * Description: Genosha plugin for API REST v3
 * Text Domain: genosha-api
 */
require plugin_dir_path(__FILE__) . '/vendor/autoload.php';

//Check if polylang exists

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')

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

define('GENOSHA_API_VERSION', '3.0.4');
define('GENOSHA_API_NAMESPACE', 'wp/v2');
define('API_GET', \WP_REST_Server::READABLE);
define('GENOSHA_API_ENVIROMENT', function_exists('api_get_enviroment') && api_get_enviroment() ? api_get_enviroment() : 'dev');
define('GENOSHA_ADMIN_ASSETS_IMAGES', plugin_dir_url(__FILE__) . 'src/assets/images');
define('GENOSHA_ADMIN_ASSETS_CSS', plugin_dir_url(__FILE__) . 'src/assets/css');
define('GENOSHA_ADMIN_ASSETS_JS', plugin_dir_url(__FILE__) . 'src/assets/js');
define('GENOSHA_PUBLIC_ASSETS_IMAGES', plugin_dir_url(__FILE__) . 'public/images');

use Gen\Api\TestApi;
use Gen\Api\Includes\IncludesInit;
use Gen\Api\Endpoints\EndpointsInit;
use Gen\Api\Admin\AdminInit;
use Gen\Api\Utils\Utils;

register_activation_hook(__FILE__, function () {
    update_option('genosha_contact_email', get_option('admin_email'));
    update_option('genosha_social_networks', maybe_serialize(genosha_fill_networks()), true);
    update_option('genosha_cookies_policy', maybe_serialize(genosha_create_cookies_options()), true);
});

register_deactivation_hook(__FILE__, function () {
    delete_option('genosha_contact_email');
    delete_option('genosha_social_networks');
    delete_option('genosha_cookies_policy');
});

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
        //Load plugin classes
        self::load_classes();
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
