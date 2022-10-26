<?php

namespace Gen\Api\Admin;

use Gen\Api\Repositories\MediaRepository as Media;

class Contact
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
        add_action('admin_init', [$this, 'save_contact']);
        add_action('admin_init', [$this, 'save_networks']);
    }

    public function menu()
    {
        add_submenu_page('genosha-api-menu', 'Contacto y Redes sociales', 'Contacto y Redes', 'manage_options', 'genosha-contact', [$this, 'callback_contact']);
    }

    public function callback_contact()
    {
        api_template_part(plugin_dir_path(__FILE__) . '/partials/contact-options');
    }

    public function save_contact()
    {
        if (isset($_POST['genosha_contact_email'])) {
            update_option('genosha_contact_email', sanitize_email($_POST['genosha_contact_email']), true);
        }
    }

    public function save_networks()
    {
        if (isset($_POST['nt-save'])) {
            update_option('genosha_social_networks', maybe_serialize($this->social_networks()), true);
        }
    }

    public function social_networks()
    {
        $social_networks = [];

        //medium            
        $mlink = sanitize_url($_POST['nt-link-medium']);
        $mimage = $_FILES['nt-upload-medium']['name'] != '' ? $_FILES['nt-upload-medium'] : $_POST['nt-image-medium'];

        if (gettype($mimage) != 'string' && isset($mimage['name'])) {
            $mupload = Media::upload_file($mimage, ['image/jpg', 'image/jpeg', 'image/png']);
            $mimage = $mupload['url'];
        }

        $medium = [
            'link' => $mlink == '' ? 'https://medium.com/@higenosha' : $mlink,
            'image' => $mimage == '' ? GENOSHA_PUBLIC_ASSETS_IMAGES . '/signal-medium.png' : $mimage,
            'active' => $_POST['nt-medium-active'] == '' ? 0 : $_POST['nt-medium-active']
        ];

        //twitter
        $tlink = sanitize_url($_POST['nt-link-twitter']);
        $timage = $_FILES['nt-upload-twitter']['name'] != '' ? $_FILES['nt-upload-twitter'] : $_POST['nt-image-twitter'];
        if (gettype($timage) != 'string' && isset($timage['name'])) {
            $tupload = Media::upload_file($timage, ['image/jpg', 'image/jpeg', 'image/png']);
            $timage = $tupload['url'];
        }
        $twitter = [
            'link' => $tlink == '' ? 'https://twitter.com/genoshans' : $tlink,
            'image' => $timage == '' ? GENOSHA_PUBLIC_ASSETS_IMAGES . '/twitter.png' : $timage,
            'active' => $_POST['nt-twitter-active'] == '' ? 0 : $_POST['nt-twitter-active']
        ];

        //instagram
        $ilink = sanitize_url($_POST['nt-link-instagram']);
        $iimage = $_FILES['nt-upload-instagram']['name'] != '' ? $_FILES['nt-upload-instagram'] : $_POST['nt-image-instagram'];
        if (gettype($iimage) != 'string' && isset($iimage['name'])) {
            $iupload = Media::upload_file($iimage, ['image/jpg', 'image/jpeg', 'image/png']);
            $iimage = $iupload['url'];
        }
        $instagram = [
            'link' => $ilink == '' ? 'https://www.instagram.com/genoshans/' : $ilink,
            'image' => $iimage == '' ? GENOSHA_PUBLIC_ASSETS_IMAGES . '/instagram.png' : $iimage,
            'active' => $_POST['nt-instagram-active'] == '' ? 0 : $_POST['nt-instagram-active']
        ];

        //dribbble
        $dlink = sanitize_url($_POST['nt-link-dribbble']);
        $dimage = $_FILES['nt-upload-dribbble']['name'] != '' ? $_FILES['nt-upload-dribbble'] : $_POST['nt-image-dribbble'];
        if (gettype($dimage) != 'string' && isset($dimage['name'])) {
            $dupload = Media::upload_file($dimage, ['image/jpg', 'image/jpeg', 'image/png']);
            $dimage = $dupload['url'];
        }
        $dribbble = [
            'link' => $dlink == '' ? 'https://dribbble.com/genosha' : $dlink,
            'image' => $dimage == '' ? GENOSHA_PUBLIC_ASSETS_IMAGES . '/dribbble.png' : $dimage,
            'active' => $_POST['nt-dribbble-active'] == '' ? 0 : $_POST['nt-dribbble-active']
        ];

        //linkedin
        $llink = sanitize_url($_POST['nt-link-linkedin']);
        $limage = $_FILES['nt-upload-linkedin']['name'] != '' ? $_FILES['nt-upload-linkedin'] : $_POST['nt-image-linkedin'];
        if (gettype($limage) != 'string' && isset($limage['name'])) {
            $lupload = Media::upload_file($limage, ['image/jpg', 'image/jpeg', 'image/png']);
            $limage = $lupload['url'];
        }
        $linkedin = [
            'link' => $llink == '' ? 'https://www.linkedin.com/company/genosha/?originalSubdomain=ar' : $llink,
            'image' => $limage == '' ? GENOSHA_PUBLIC_ASSETS_IMAGES . '/linkedin.png' : $limage,
            'active' => $_POST['nt-linkendin-active'] == '' ? 0 : $_POST['nt-linkendin-active']
        ];

        //yotube
        $ylink = sanitize_url($_POST['nt-link-youtube']);
        $yimage = $_FILES['nt-upload-youtube']['name'] != '' ? $_FILES['nt-upload-youtube'] : $_POST['nt-image-youtube'];
        if (gettype($yimage) != 'string' && isset($yimage['name'])) {
            $yupload = Media::upload_file($yimage, ['image/jpg', 'image/jpeg', 'image/png']);
            $yimage = $yupload['url'];
        }
        $youtube = [
            'link' => $ylink == '' ? 'https://www.youtube.com/' : $ylink,
            'image' => $yimage == '' ? GENOSHA_PUBLIC_ASSETS_IMAGES . '/youtube.png' : $yimage,
            'active' => $_POST['nt-youtube-active'] == '' ? 0 : $_POST['nt-youtube-active']
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
