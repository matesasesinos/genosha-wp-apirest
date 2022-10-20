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
        if(!$option || $option == '') {
            return false;
        }

        return maybe_unserialize( $option );
    }
}

if (!function_exists('api_get_enviroment')) {
    function api_get_enviroment()
    {
        if(!api_get_options() || api_get_options()['enviroment'] == null) {
            return false;
        }
        return api_get_options()['enviroment'];
    }
}
