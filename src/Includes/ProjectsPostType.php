<?php

namespace Gen\Api\Includes;

use Gen\Api\Interfaces\IPostType;

class ProjectsPostType implements IPostType
{
    private static $init;
    public $post_type = 'projects';
    public static function init()
    {
        if(is_null(self::$init)) {
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
            'supports' => ['title', 'editor'],
            'show_in_graphql' => false,
        ];

        register_post_type('projects', $args);
    }

    public function taxonomies()
    {
    }

    public function gutenber($use_gutenberg, $post){
        if( $post->post_type === $this->post_type ) {
            $use_gutenberg = false;
        }
        return $use_gutenberg;
    }
}
