<?php

namespace Gen\Api\Endpoints;

class Projects
{
    private static $init;
    public static function init()
    {
        if(is_null(self::$init)) {
            self::$init = new self();
        }

        return self::$init;
    }

    public function __construct()
    {
        add_action('rest_api_init', [$this,'routes']);
    }

    public function routes()
    {
        register_rest_route( GENOSHA_API_NAMESPACE, '/projects', [
            'methods' => API_GET,
            'callback' => [$this,'get_projects'],
            'permission_callback' => '__return_true'
        ]);
    }

    public function get_projects(\WP_REST_Request $r)
    {
        return wp_send_json_success( 'Hellooo' );
    }
}