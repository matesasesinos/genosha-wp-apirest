<?php

namespace Gen\Api\Includes;

class TeamPostType
{
    private static $init;
    public $post_type = 'team';

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
        add_action('init', [$this, 'taxonomies']);
        add_filter('use_block_editor_for_post_type', [$this, 'gutenberg'], 10, 2);
    }
    public function post_type()
    {
        $labels = [
            'name' => esc_html__('Equipo Genosha', 'genosha-api'),
            'singular_name' => esc_html__('Equipos', 'genosha-api'),
            'all_items' => esc_html__('Equipo Genosha', 'genosha-api'),
        ];

        $args = [
            'label' => esc_html__('Equipo Genosha', 'genosha-api'),
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
            'supports' => ['title', 'thumbnail', 'editor'],
            'menu_icon' => 'dashicons-admin-multisite',
            'show_in_graphql' => true,
            'graphql_single_name' => 'Equipo',
            'graphql_plural_name' => 'Equipos',
        ];

        register_post_type('team', $args);
    }

    public function taxonomies()
    {
        $labels = [
            'name' => esc_html__('Areas', 'genosha-api'),
            'singular_name' => esc_html__('Areas', 'genosha-api'),
        ];


        $args = [
            'label' => esc_html__('Areas', 'genosha-api'),
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'query_var' => true,
            'rewrite' => ['slug' => 'team_area', 'with_front' => true,],
            'show_admin_column' => true,
            'show_in_rest' => true,
            'show_tagcloud' => false,
            'rest_base' => 'team_area',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
            'rest_namespace' => 'wp/v2',
            'show_in_quick_edit' => true,
            'sort' => false,
            'show_in_graphql' => true,
            'graphql_single_name' => 'Areas',
            'graphql_plural_name' => 'Areas',
        ];
        register_taxonomy('team_area', ['team'], $args);
    }

    public function gutenberg($use_gutenberg, $post_type)
    {
        if ($post_type === $this->post_type) {
            $use_gutenberg = false;
        }
        return $use_gutenberg;
    }
}