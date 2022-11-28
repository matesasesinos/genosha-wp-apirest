<?php

namespace Gen\Api\Endpoints;

use Gen\Api\Repositories\PostRepository as Repo;

class Services extends EndpointsInit
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
        register_rest_route(GENOSHA_API_NAMESPACE, '/services', [
            'methods' => API_GET,
            'callback' => [$this, 'get_services'],
            'permission_callback' => [$this, 'endpoints_permissions']
        ]);
    }

    public function get_services(\WP_REST_Request $r)
    {
        $lang = $r->get_param('lang') ? $r->get_param('lang') : 'es';
        $args = [
            'post_type' => 'services',
            'post_status' => 'publish',
            'numberposts' => -1,
            'lang' => $lang
        ];

        $projects = Repo::get_all_posts($args, '', '', '_genosha_service_content');

        if (!$projects) {
            return wp_send_json_error('No services found', 404);
        }
        
        return wp_send_json_success($projects);
    }
}