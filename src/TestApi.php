<?php

namespace Gen\Api;

class TestApi
{
    private static $init = false;
    public static function init()
    {
        if(self::$init)
            return;
        self::$init = true;

        add_action('rest_api_init', [__CLASS__,'endpoint']);
    }

    public static function endpoint()
    {
        register_rest_route(GENOSHA_API_NAMESPACE, '/test', [
            'methods' => 'GET',
            'callback' => [__CLASS__,'test'],
            'permission_callback' => '__return_true'
        ]);
    }

    public static function test()
    {
        return wp_send_json_success( 'Hello World from Genosha API' );
    }
}