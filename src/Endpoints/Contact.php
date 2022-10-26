<?php

namespace Gen\Api\Endpoints;


class Contact extends EndpointsInit
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
        register_rest_route(GENOSHA_API_NAMESPACE, '/contact-email', [
            'methods' => API_GET,
            'callback' => [$this, 'get_email'],
            'permission_callback' => [$this, 'endpoints_permissions']
        ]);
        register_rest_route(GENOSHA_API_NAMESPACE, '/social-networks', [
            'methods' => API_GET,
            'callback' => [$this, 'get_social_networks'],
            'permission_callback' => [$this, 'endpoints_permissions']
        ]);
    }

    public function get_email()
    {
        return wp_send_json_success(get_option('genosha_contact_email'));
    }

    public function get_social_networks()
    {
        $networks = maybe_unserialize( get_option('genosha_social_networks') );

        if(!$networks) {
            return wp_send_json_error('No hay redes sociales', 404);
        }

        return wp_send_json_success($networks);
    }
}