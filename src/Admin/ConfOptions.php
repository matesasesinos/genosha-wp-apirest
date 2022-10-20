<?php

namespace Gen\Api\Admin;

use Gen\Api\Interfaces\IMenuOPtions;

class ConfOptions implements IMenuOPtions
{
    private static $init;
    public static function init()
    {
        if (is_null(self::$init)) {
            self::$init = new self();
        }

        return self::$init;
    }

    public function __construct()
    {
        add_action('admin_menu', [$this,'menu']);
        add_action('admin_init', [$this, 'save_options']);
    }

    public function menu()
    {
        add_menu_page('Genosha', 'Genosha', 'manage_options', 'genosha-api-menu', [$this, 'callback'], GENOSHA_ADMIN_ASSETS_IMAGES.'/genosha-icon.png', 30);
    }

    public function callback()
    {
        api_template_part(plugin_dir_path( __FILE__ ).'/partials/conf-options');
    }

    public function save_options()
    {
        if(isset($_POST['genosha-api-save-options'])) {
            $options = [
                'enviroment' => isset($_POST['genosha-api-enviroment']) ? $_POST['genosha-api-enviroment'] : 'dev'
            ];

            update_option('_genosha_api_options', maybe_serialize( $options ), true);
        }
    }
}
