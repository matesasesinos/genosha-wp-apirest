<?php

namespace Gen\Api\Endpoints;


class Skybox extends EndpointsInit
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
        register_rest_route(GENOSHA_API_NAMESPACE, '/skybox-images', [
            'methods' => API_GET,
            'callback' => [$this, 'get_skybox'],
            'permission_callback' => [$this, 'endpoints_permissions']
        ]);
    }

    public function get_skybox()
    {
        $skybox = get_option('skybox_images');

        if(!$skybox) {
            return wp_send_json_error('No hay imagenes para el skybox!');
        }

        return wp_send_json_success(maybe_unserialize( $skybox ));
    }
}