<?php

namespace Gen\Api\Admin;

use Gen\Api\Repositories\MediaRepository as Media;

class Skybox
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
        add_action('admin_menu', [$this, 'menu']);
        add_action('admin_init', [$this, 'save_skybox']);
    }

    public function menu()
    {
        add_submenu_page('genosha-api-menu', 'Skybox', 'Skybox', 'manage_options', 'genosha-skybox', [$this, 'callback_skybox']);
    }
    public function callback_skybox()
    {
        api_template_part(plugin_dir_path(__FILE__) . '/partials/skybox');
    }
    public function save_skybox()
    {
        if (!isset($_POST['skybox_nonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['skybox_nonce'], 'skybox')) {
            return;
        }

        $skybox_top = $_FILES['skybox-top']['name'] != '' ? $_FILES['skybox-top'] : $_POST['skybox-top-img'];
        $skybox_left = $_FILES['skybox-left']['name'] != '' ? $_FILES['skybox-left'] : $_POST['skybox-left-img'];
        $skybox_front = $_FILES['skybox-front']['name'] != '' ? $_FILES['skybox-front'] : $_POST['skybox-front-img'];
        $skybox_right = $_FILES['skybox-right']['name'] != '' ? $_FILES['skybox-right'] : $_POST['skybox-right-img'];
        $skybox_back = $_FILES['skybox-back']['name'] != '' ? $_FILES['skybox-back'] : $_POST['skybox-back-img'];
        $skybox_bottom = $_FILES['skybox-bottom']['name'] != '' ? $_FILES['skybox-bottom'] : $_POST['skybox-bottom-img'];

        if($skybox_top == '' || $skybox_left == '' || $skybox_front == '' || $skybox_right == '' || $skybox_back == '' || $skybox_bottom == '') {
            wp_redirect(admin_url('admin.php?page=genosha-skybox&error_field=empty'));
            exit();
        }
        $errors = false;
        if(gettype($skybox_top) != 'string' && isset($skybox_top['name'])) {
            $top = Media::upload_file($skybox_top, ['image/jpeg', 'image/png']);

            if(is_wp_error($top)) {
                $errors = true;
            }

            $skybox_top = $top['url'];
        }

        if(gettype($skybox_left) != 'string' && isset($skybox_left['name'])) {
            $left = Media::upload_file($skybox_left, ['image/jpeg', 'image/png']);

            if(is_wp_error($left)) {
                $errors = true;
            }

            $skybox_left = $left['url'];
        }

        if(gettype($skybox_front) != 'string' && isset($skybox_front['name'])) {
            $front = Media::upload_file($skybox_front, ['image/jpeg', 'image/png']);

            if(is_wp_error($front)) {
                $errors = true;
            }

            $skybox_front = $front['url'];
        }

        if(gettype($skybox_right) != 'string' && isset($skybox_right['name'])) {
            $right = Media::upload_file($skybox_right, ['image/jpeg', 'image/png']);

            if(is_wp_error($right)) {
                $errors = true;
            }

            $skybox_right = $right['url'];
        }

        if(gettype($skybox_back) != 'string' && isset($skybox_back['name'])) {
            $back = Media::upload_file($skybox_back, ['image/jpeg', 'image/png']);

            if(is_wp_error($back)) {
                $errors = true;
            }

            $skybox_back = $back['url'];
        }        

        if(gettype($skybox_bottom) != 'string' && isset($skybox_bottom['name'])) {
            $bottom = Media::upload_file($skybox_bottom, ['image/jpeg', 'image/png']);

            if(is_wp_error($bottom)) {
                $errors = true;
            }

            $skybox_bottom = $bottom['url'];
        }      

        if($errors) {
            wp_redirect(admin_url('admin.php?page=genosha-skybox&error_field=error_upload'));
            exit();
        }
     
        $skybox = [
            'top' => $skybox_top,
            'left' => $skybox_left,
            'front' => $skybox_front,
            'right' => $skybox_right,
            'back' => $skybox_back,
            'bottom' => $skybox_bottom
        ];

        $save = update_option('skybox_images', maybe_serialize($skybox), true);
        if($save) {
            wp_redirect(admin_url('admin.php?page=genosha-skybox&success=saved'));
            exit();
        }

        wp_redirect(admin_url('admin.php?page=genosha-skybox&error_field=save_error'));
        exit();
     }
}
