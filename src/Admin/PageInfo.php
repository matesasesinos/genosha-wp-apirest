<?php

namespace Gen\Api\Admin;

class PageInfo
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
        add_action('admin_init', [$this, 'save_pages']);
    }

    public function menu()
    {
        add_submenu_page('genosha-api-menu', 'Páginas e Info', 'Páginas e Info', 'manage_options', 'genosha-pages', [$this, 'callback_pages']);
    }

    public function callback_pages()
    {
        api_template_part(plugin_dir_path(__FILE__) . '/partials/pages-options');
    }

    public function save_pages()
    {
        if(isset($_POST['genosha-cookies-save'])) {
            $cookies = [
                'cookies_text_en' => $_POST['genosha_cookies_text_en'],
                'cookies_text_es' => $_POST['genosha_cookies_text_es'],
                'cookies_page_en' => $_POST['genosha_cookies_page_en'],
                'cookies_page_es' => $_POST['genosha_cookies_page_es'],
            ];

            update_option('genosha_cookies_policy', maybe_serialize($cookies), true);
        }
    }
}