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

if (!function_exists('genosha_get_pages')) {
    function genosha_get_pages($lang)
    {
        $args = [
            'post_type' => 'page',
            'numberposts' => -1,
            'lang' => $lang
        ];

        $posts = get_posts($args);

        if(!$posts) {
            return false;
        }

        $pages = [];
        foreach($posts as $pg) {
            $page = [
                'ID' => $pg->ID,
                'title' => $pg->post_title
            ];
            array_push($pages,$page);
        }
        return $pages;
    }
}

if (!function_exists('genosha_create_post')) {
    function genosha_create_post($data)
    {
        $post = wp_insert_post([
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'page',
            'post_title' => sanitize_text_field($data['title']),
            'post_name' => sanitize_title($data['title']),
            'post_content' => sanitize_text_field($data['content'])
        ]);

        if(!$post) {
            return false;
        }
        //https://polylang.pro/doc/function-reference/
        return $post;
    }
}

if (!function_exists('genosha_create_cookies_pages')) {
    function genosha_create_cookies_options()
    {
        $title_en = 'Cookies policy';
        $title_es = 'Política de cookies';
        $content = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim eos molestiae est? Asperiores quas omnis eius amet nam itaque voluptatibus. Quidem, deserunt! Odit nobis ducimus quibusdam qui fugit eligendi quis sequi cupiditate tempore, maxime ullam dolorem, magnam consequatur inventore velit, expedita fugiat repellat necessitatibus dicta! Ab maiores voluptates repellat dolore.';

        $create_es = genosha_create_post([
            'title' => $title_es,
            'content' => $content
        ]);
        
        if($create_es) {
            pll_set_post_language($create_es,'es');

            $create_en = genosha_create_post([
                'title' => $title_en,
                'content' => $content
            ]);

            pll_set_post_language($create_en,'en');
            pll_save_post_translations($create_es,$create_en);

            $cookies = [
                'cookies_text_en' => 'We use cookies to enhance your browsing experience, serve personalized ads or content, and analyze our traffic. By clicking "Accept All", you consent to our use of cookies.',
                'cookies_text_es' => 'Usamos cookies para mejorar su experiencia de navegación, mostrar anuncios o contenido personalizados y analizar nuestro tráfico. Al hacer clic en "Aceptar todo", usted acepta nuestro uso de cookies.',
                'cookies_page_en' => $create_en,
                'cookies_page_es' => $create_es
            ];

            return $cookies;
        }

        die('Error al crear la política de cookies.');
    }
}
