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
        $page_meta_desc = $lang == 'es' ? get_post_meta($cookies['cookies_page_es'], '_yoast_wpseo_metadesc', true) : get_post_meta($cookies['cookies_page_en'], '_yoast_wpseo_metadesc', true);

        $og_title = $lang == 'es' ? get_post_meta($cookies['cookies_page_es'], '_yoast_wpseo_opengraph-title', true) : get_post_meta($cookies['cookies_page_en'], '_yoast_wpseo_opengraph-title', true);
        $og_description = $lang == 'es' ? get_post_meta($cookies['cookies_page_es'], '_yoast_wpseo_opengraph-description', true) : get_post_meta($cookies['cookies_page_en'], '_yoast_wpseo_opengraph-description', true);
        $og_image = $lang == 'es' ? get_post_meta($cookies['cookies_page_es'], '_yoast_wpseo_opengraph-image', true) : get_post_meta($cookies['cookies_page_en'], '_yoast_wpseo_opengraph-image', true);
        $og_tw_title = $lang == 'es' ? get_post_meta($cookies['cookies_page_es'], '_yoast_wpseo_twitter-title', true) : get_post_meta($cookies['cookies_page_en'], '_yoast_wpseo_twitter-title', true);
        $og_tw_description = $lang == 'es' ? get_post_meta($cookies['cookies_page_es'], '_yoast_wpseo_twitter-description', true) : get_post_meta($cookies['cookies_page_en'], '_yoast_wpseo_twitter-description', true);
        $og_tw_image = $lang == 'es' ? get_post_meta($cookies['cookies_page_es'], '_yoast_wpseo_twitter-image', true) : get_post_meta($cookies['cookies_page_en'], '_yoast_wpseo_twitter-image', true);
        $og_locale = $lang == 'es' ? 'es' : 'en';

        $this_cookie = [
            'text' => $lang == 'es' ? $cookies['cookies_text_es'] : $cookies['cookies_text_en'],
            'page_title' => $page_title,
            'page_content' => $page_content,
            'page_metadesc' => $page_meta_desc,
            'og_title' => $og_title,
            'og_description' => $og_description,
            'og_image' => $og_image,
            'og_tw_title' => $og_tw_title,
            'og_tw_description' => $og_tw_description,
            'og_tw_image' => $og_tw_image,
            'og_locale' => $og_locale
        ];

        return wp_send_json_success($this_cookie);
    }
}