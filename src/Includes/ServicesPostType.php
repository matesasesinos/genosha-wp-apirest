<?php

namespace Gen\Api\Includes;

class ServicesPostType
{
    private static $init;
    public $post_type = 'services';

    public static function init()
    {
        if (is_null(self::$init)) {
            self::$init = new self();
        }

        return self::$init;
    }

    public function __construct()
    {
        add_action('init', [$this, 'post_type']);
    }

    public function post_type()
    {
        $labels = [
            'name' => esc_html__('Servicios', 'genosha-api'),
            'singular_name' => esc_html__('Servicio', 'genosha-api'),
        ];

        $args = [
            'label' => esc_html__('Servicios', 'genosha-api'),
            'labels' => $labels,
            'description' => '',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'rest_base' => '',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'rest_namespace' => 'wp/v2',
            'has_archive' => false,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'delete_with_user' => false,
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'hierarchical' => false,
            'can_export' => false,
            'rewrite' => ['slug' => $this->post_type, 'with_front' => true],
            'query_var' => true,
            'menu_icon' => 'dashicons-images-alt',
            'supports' => ['title'],
            'show_in_graphql' => true,
            'graphql_single_name' => 'Service',
            'graphql_plural_name' => 'Services',
        ];

        register_post_type('services', $args);
    }
    
    public function gutenber($use_gutenberg, $post)
    {
        if ($post->post_type === $this->post_type) {
            $use_gutenberg = false;
        }
        return $use_gutenberg;
    }
}
