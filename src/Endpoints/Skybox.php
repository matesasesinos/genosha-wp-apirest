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
        register_rest_route(GENOSHA_API_NAMESPACE, '/skybox-card', [
            'methods' => API_GET,
            'callback' => [$this, 'get_skybox_card'],
            'permission_callback' => [$this, 'endpoints_permissions']
        ]);
    }

    public function get_skybox()
    {
        $skybox = get_option('skybox_images');

        if (!$skybox) {
            return wp_send_json_error('No hay imagenes para el skybox!');
        }

        return wp_send_json_success(maybe_unserialize($skybox));
    }

    public function get_skybox_card(\WP_REST_Request $r)
    {
        $lang = $r->get_param('lang');

        if (!$lang) {
            return wp_send_json_error('Debe proporcionar un idioma para obtener el Skybox', 401);
        }

        $skybox_card = maybe_unserialize(get_option('skybox_card'));

        if (!$skybox_card) {
            return wp_send_json_error('Skybox Card vacía!', 404);
        }
        $areas = get_the_terms( $skybox_card['author'], 'team_area' );
        $card = [
            'title' => $lang == 'en' ? $skybox_card['title_en'] : $skybox_card['title_es'],
            'image' => $skybox_card['image'],
            'author_name' => $skybox_card['author_name'],
            'author_img' => $skybox_card['author_img'],
            'author_text' => $lang == 'en' ? $skybox_card['author_text_en'] : $skybox_card['author_text_es'],
            'author_position' => join(', ', wp_list_pluck($areas, 'name')),
        ];

        return wp_send_json_success($card);
    }
}
