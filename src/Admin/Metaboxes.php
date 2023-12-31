<?php

namespace Gen\Api\Admin;

use Gen\Api\Repositories\MediaRepository as Media;

class Metaboxes
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
        add_action('add_meta_boxes', [$this, 'add_metaboxes']);
        add_action('save_post', [$this, 'projects_save_fields']);
        add_action('save_post', [$this, 'services_save_fields']);
        add_action('post_edit_form_tag', [$this, 'multipart_form_tag']);
    }

    public function multipart_form_tag()
    {
        $post_types = ['projects', 'services'];
        if (isset($_GET['post']) && !in_array(get_post_type($_GET['post']), $post_types)) {
            return;
        }
        if (isset($_GET['post_type']) && !in_array($_GET['post_type'], $post_types)) {
            return;
        }
        echo ' enctype="multipart/form-data"';
    }

    public function add_metaboxes()
    {
        add_meta_box('genosha_metabox_projects', 'Contenido', [$this, 'projects_fields'], ['projects'], 'normal');
        add_meta_box('genosha_metabox_services', 'Contenido', [$this, 'services_fields'], ['services'], 'normal');
    }

    public function projects_fields($post)
    {
        $project_content = maybe_unserialize( base64_decode(get_post_meta($post->ID, '_genosha_project_content', true)) );

        api_template_part(plugin_dir_path(__FILE__) . '/partials/metas/meta-projects', [
            'subtitle' =>  $project_content && isset($project_content['subtitle']) != '' ? stripslashes($project_content['subtitle']) : '',
            'description' => $project_content && isset($project_content['description']) != '' ? stripslashes($project_content['description']) : '',
            'link' => $project_content && isset($project_content['link']) != '' ? $project_content['link'] : '',
            'file_url' => $project_content && isset($project_content['file_url']) != '' ? $project_content['file_url'] : '',
            'file_name' => $project_content && isset($project_content['file_name']) != '' ? $project_content['file_name'] : '',
        ]);
    }

    public function projects_save_fields($post_id)
    {
        if (!isset($_POST['project_meta_boxes_nonce'])) {
            return $post_id;
        }

        if (!wp_verify_nonce($_POST['project_meta_boxes_nonce'], 'project_meta_boxes')) {
            return $post_id;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return false;
        }


        $subtitle = sanitize_text_field($_POST['project-subtitle']);
        $description = sanitize_text_field($_POST['project-description']);
        $link = sanitize_url($_POST['project-link']);
        

        $data = [
            'subtitle' => $subtitle,
            'description' => $description,
            'link' => $link
        ];

         if ($_FILES['project-file']['name'] != '') {
            $media = Media::upload_file($_FILES['project-file'], []);
            if (is_wp_error($media)) {
                return $media->get_error_message();
            }
            $file_url = $media['url'];
            $file_name = $_FILES['project-file']['name'];
        } else {
            $file_url = $_POST['project-file-url'];
            $file_name = $_POST['project-file-name'];
        }

        $data['file_url'] = $file_url;
        $data['file_name'] = $file_name;
        
    
        update_post_meta($post_id, '_genosha_project_content', base64_encode(maybe_serialize( $data )));
    }

    public function services_fields($post)
    {
        $service_content =  maybe_unserialize(base64_decode(get_post_meta($post->ID, '_genosha_service_content', true)));
        api_template_part(plugin_dir_path(__FILE__) . '/partials/metas/meta-services', [
            'data' => $service_content ? $service_content : '',
            'tag1' => $service_content && isset($service_content['tag1']) != '' ? stripslashes($service_content['tag1']) : '',
            'tag2' => $service_content && isset($service_content['tag2']) != '' ? stripslashes($service_content['tag2']) : '',
            'tag3' => $service_content && isset($service_content['tag3']) != '' ? stripslashes($service_content['tag3']) : '',
            'tag4' => $service_content && isset($service_content['tag4']) != '' ? stripslashes($service_content['tag4']) : '',
            'video1_url' => $service_content && isset($service_content['video1_url']) != '' ? $service_content['video1_url'] : '',
            'video2_url' => $service_content && isset($service_content['video2_url']) != '' ? $service_content['video2_url'] : '',
        ]);
    }

    public function services_save_fields($post_id)
    {
        if (!isset($_POST['service_meta_boxes_nonce'])) {
            return $post_id;
        }

        if (!wp_verify_nonce($_POST['service_meta_boxes_nonce'], 'service_meta_boxes')) {
            return $post_id;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return false;
        }

        $tag1 = sanitize_text_field( $_POST['service-tag1'] );
        $tag2 = sanitize_text_field( $_POST['service-tag2'] );
        $tag3 = sanitize_text_field( $_POST['service-tag3'] );
        $tag4 = sanitize_text_field( $_POST['service-tag4'] );
        $video1 = $_FILES['services-file1'];
        $video2 = $_FILES['services-file2'];

        $data = [
            'tag1' => $tag1,
            'tag2' => $tag2,
            'tag3' => $tag3,
            'tag4' => $tag4,
        ];

        if($video1['name'] != '') {
            $media1 = Media::upload_file($video1, ['video/mp4']);
            if (is_wp_error($media1)) {
                return $media1->get_error_message();
            }
            $video1_url = $media1['url'];
        } else {
            $video1_url = $_POST['service-file1-url'];
        }

        if($video2['name'] != '') {
            $media2 = Media::upload_file($video2, ['video/mp4']);
            if (is_wp_error($media2)) {
                return $media2->get_error_message();
            }
            $video2_url = $media2['url'];
        } else {
            $video2_url = $_POST['service-file2-url'];
        }

        $data['video1_url'] = $video1_url;
        $data['video2_url'] = $video2_url;

        update_post_meta($post_id, '_genosha_service_content', base64_encode(maybe_serialize($data)));
    }
}
