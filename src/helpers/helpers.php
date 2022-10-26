<?php

if (!function_exists('api_template_part')) {
    function api_template_part(string $template, array $params = null)
    {
        ob_start();

        if ($params != null) extract($params, EXTR_SKIP);

        require $template . '.php';
    }
}

if (!function_exists('api_get_options')) {
    function api_get_options()
    {
        $option = get_option('_genosha_api_options');
        if (!$option || $option == '') {
            return false;
        }

        return maybe_unserialize($option);
    }
}

if (!function_exists('api_get_enviroment')) {
    function api_get_enviroment()
    {
        if (!api_get_options() || api_get_options()['enviroment'] == null) {
            return false;
        }
        return api_get_options()['enviroment'];
    }
}

if (!function_exists('genosha_team_query')) {
    function genosha_team_query()
    {
        $args = [
            'post_type' => 'team',
            'numberposts' => -1
        ];

        $posts = get_posts($args);

        if (!$posts) {
            return new \WP_Error('team-empty', 'No hay miembros de equipo');
        }
        $teams = [];
        foreach ($posts as $team) {
            $areas = get_the_terms($team->ID, 'team_area');
            $data = [
                'ID' => $team->ID,
                'name' => $team->post_title,
                'bio' => $team->post_content,
                'image' => get_the_post_thumbnail_url($team->ID),
                'areas' =>  join(', ', wp_list_pluck($areas, 'name')),
            ];

            array_push($teams, $data);
        }

        return $teams;
    }
}

if (!function_exists('genosha_fill_networks')) {
    function genosha_fill_networks()
    {
        $social_networks = [];

        $medium = [
            'link' => 'https://medium.com/@higenosha',
            'image' => GENOSHA_PUBLIC_ASSETS_IMAGES . '/signal-medium.png',
            'active' => 0
        ];

        $twitter = [
            'link' => 'https://twitter.com/genoshans',
            'image' => GENOSHA_PUBLIC_ASSETS_IMAGES . '/twitter.png',
            'active' => 1
        ];

        $instagram = [
            'link' => 'https://www.instagram.com/genoshans/',
            'image' => GENOSHA_PUBLIC_ASSETS_IMAGES . '/instagram.png',
            'active' => 1
        ];

        $dribbble = [
            'link' => 'https://dribbble.com/genosha',
            'image' => GENOSHA_PUBLIC_ASSETS_IMAGES . '/dribbble.png',
            'active' => 1
        ];

        $linkedin = [
            'link' => 'https://www.linkedin.com/company/genosha/?originalSubdomain=ar',
            'image' => GENOSHA_PUBLIC_ASSETS_IMAGES . '/linkedin.png',
            'active' => 1
        ];

        $youtube = [
            'link' => 'https://www.youtube.com/',
            'image' => GENOSHA_PUBLIC_ASSETS_IMAGES . '/youtube.png',
            'active' => 0
        ];

        $data = array_merge($social_networks, [
            'medium' => $medium,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'dribbble' => $dribbble,
            'linkedin' => $linkedin,
            'youtube' => $youtube,
        ]);

        return $data;
    }
}
