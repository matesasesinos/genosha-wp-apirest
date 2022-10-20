<?php

namespace Gen\Api\Admin;

use Gen\Api\Interfaces\IOPtions;

class HelpOptions implements IOPtions
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
        add_action('admin_menu', [$this, 'menu']);
    }

    public function menu()
    {
        add_submenu_page( 'genosha-api-menu', 'Autorización', 'Autorización', 'manage_options', 'genosha-api-auth', [$this, 'callback_auth']);
        add_submenu_page( 'genosha-api-menu', 'Ayuda', 'Ayuda', 'manage_options', 'genosha-api-help', [$this, 'callback']);
    }
    public function callback()
    {
        api_template_part(plugin_dir_path( __FILE__ ).'/partials/help-options');
    }
    public function callback_auth()
    {
        api_template_part(plugin_dir_path( __FILE__ ).'/partials/auth-options');
    }
    public function save_options()
    {
    }
}
