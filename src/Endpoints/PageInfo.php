<?php

namespace Gen\Api\Endpoints;

class PageInfo extends EndpointsInit
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
        add_action('rest_api_init', [$this, 'routes']);
    }

    public function routes()
    {
        register_rest_route(GENOSHA_API_NAMESPACE, '/cookies-info', [
            'methods' => API_GET,
            'callback' => [$this, 'get_cookies'],
            'permission_callback' => [$this, 'endpoints_permissions']
        ]);
    }

    public function get_cookies(\WP_REST_Request $r)
    {
        $lang = $r->get_param('lang');

        if(!$lang) {
            return wp_send_json_success( 'Falta el idioma', 401 );
        }

        $cookies = maybe_unserialize( get_option('genosha_cookies_policy') );

        if(!$cookies) {
            return wp_send_json_success( 'No hay información de cookies', 404 );
        }
        $page_title = $lang == 'es' ? get_the_title($cookies['cookies_page_es']) : get_the_title($cookies['cookies_page_en']);
        $page_content = $lang == 'es' ? get_post($cookies['cookies_page_es'])->post_content : get_post($cookies['cookies_page_en'])->post_content;

        $this_cookie = [
            'text' => $lang == 'es' ? $cookies['cookies_text_es'] : $cookies['cookies_text_en'],
            'page_title' => $page_title,
            'page_content' => $page_content
        ];

        return wp_send_json_success($this_cookie);
    }
}