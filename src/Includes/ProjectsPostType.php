<?php

namespace Gen\Api\Includes;

class ProjectsPostType
{
    private static $init;
    public $post_type = 'projects';
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
        add_filter('use_block_editor_for_post_type', [$this,'gutenberg'], 10, 2);
    }

    public function post_type()
    {
        $labels = [
            'name' => esc_html__('Proyectos', 'genosha-api'),
            'singular_name' => esc_html__('Proyecto', 'genosha-api'),
            'menu_name' => esc_html__('Proyectos', 'genosha-api'),
            'all_items' => esc_html__('Proyectos', 'genosha-api'),
            'add_new' => esc_html__('Nuevo', 'genosha-api'),
            'add_new_item' => esc_html__('Nuevo', 'genosha-api'),
            'edit_item' => esc_html__('Editar', 'genosha-api'),
            'new_item' => esc_html__('Nuevo', 'genosha-api'),
            'view_item' => esc_html__('Ver', 'genosha-api'),
            'view_items' => esc_html__('Ver todos', 'genosha-api'),
            'search_items' => esc_html__('Buscar', 'genosha-api'),
            'not_found' => esc_html__('No se encontro proyectos', 'genosha-api'),
            'not_found_in_trash' => esc_html__('No hay nada en la papelera', 'genosha-api'),
            'parent' => esc_html__('Padre', 'genosha-api'),
            'featured_image' => esc_html__('Imagen destacada', 'genosha-api'),
            'insert_into_item' => esc_html__('Insertar', 'genosha-api'),
            'name_admin_bar' => esc_html__('Nuevo Proyecto', 'genosha-api'),
            'item_published' => esc_html__('Proyecto publicado', 'genosha-api'),
            'item_published_privately' => esc_html__('Publicado como privado', 'genosha-api'),
            'parent_item_colon' => esc_html__('Padre', 'genosha-api'),
        ];

        $args = [
            'label' => esc_html__('Proyectos', 'genosha-api'),
            'labels' => $labels,
            'description' => '',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_rest' => false,
            'rest_base' => '',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'rest_namespace' => 'genosha/v3',
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
            'menu_icon' => 'dashicons-art',
            'supports' => ['title'],
            'show_in_graphql' => true,
            'graphql_single_name' => 'Proyecto',
            'graphql_plural_name' => 'Proyectos'
        ];

        register_post_type('projects', $args);
    }

    public function taxonomies()
    {
        $labels = [
            'name' => esc_html__('Tags', 'genosha-api'),
            'singular_name' => esc_html__('Tag', 'genosha-api'),
        ];


        $args = [
            'label' => esc_html__('Tags', 'genosha-api'),
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'query_var' => true,
            'rewrite' => ['slug' => 'tags_projects', 'with_front' => true,],
            'show_admin_column' => true,
            'show_in_rest' => true,
            'show_tagcloud' => true,
            'rest_base' => 'tags_projects',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
            'rest_namespace' => 'genosha/v3',
            'show_in_quick_edit' => true,
            'sort' => false,
            'show_in_graphql' => true,
            'graphql_single_name' => 'Tags_Proyecto',
            'graphql_plural_name' => 'Tags_Proyectos'
        ];
        register_taxonomy('tags_projects', ['projects'], $args);
    }
    
    public function gutenberg($use_gutenberg, $post_type)
    {
        if ($post_type === $this->post_type) {
            $use_gutenberg = false;
        }
        return $use_gutenberg;
    }
}
