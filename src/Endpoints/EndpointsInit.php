<?php

namespace Gen\Api\Endpoints;

use Gen\Api\Endpoints\Projects;
use Gen\Api\Endpoints\Services;

class EndpointsInit
{
    private static $init = false;
    public static function init()
    {
        if(self::$init)
            return;
        self::$init = true;

        self::load_classes();
    }

    public static function load_classes()
    {
        Projects::init();
        Services::init();
    }

    public function endpoints_permissions()
    {
        if(!is_user_logged_in()) {
            return new \WP_Error('not-logged', __('You must be logged for access to data.', 'genosha-api'), 403);
        }

        $role = get_userdata(get_current_user_id())->roles;

        if(in_array('administrator', $role) || in_array('subscriber', $role)) {
            return true;
        }

        return new \WP_Error('not-permission', __('You don\'t have permissions for this resource.', 'genosha-api'), 401);
    }
}