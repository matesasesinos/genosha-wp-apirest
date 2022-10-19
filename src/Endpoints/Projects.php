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
        $args = [
            'post_type' => 'projects',
            'post_status' => 'publish',
            'numberposts' => -1
        ];

        $posts = get_posts($args);

        if(!$posts) {
            return wp_send_json_error('No projects found', 404);
        }

        $projects = [];
        foreach($posts as $project) {
            $data = [
                'title' => $project->post_title,
                'content' => $project->post_content
            ];
            array_push($projects,$data);
        }

        return wp_send_json_success($projects);
    }
}