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
        add_action('post_edit_form_tag', [$this, 'multipart_form_tag']);
    }

    public function multipart_form_tag()
    {
        $post_types = ['projects'];
        if (isset($_GET['post']) && !in_array(get_post_type($_GET['post']), $post_types)) {
            return;
        }
        if(isset($_GET['post_type']) && !in_array($_GET['post_type'], $post_types)) {
            return;
        }
        echo ' enctype="multipart/form-data"';
    }

    public function add_metaboxes()
    {
        add_meta_box('genosha_metabox_projects', 'Contenido', [$this, 'projects_fields'], ['projects'], 'normal');
    }

    public function projects_fields($post)
    {
        $project_content = is_serialized( get_post_meta($post->ID, '_genosha_project_content', true)) ? maybe_unserialize(get_post_meta($post->ID, '_genosha_project_content', true)) : get_post_meta($post->ID, '_genosha_project_content', true);

        api_template_part(plugin_dir_path(__FILE__) . '/partials/metas/meta-projects', [
            'subtitle' =>  $project_content && isset($project_content['subtitle']) != '' ? $project_content['subtitle'] : '',
            'description' => $project_content && isset($project_content['description']) != '' ? $project_content['description'] : '',
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

        if ( ! wp_verify_nonce( $_POST['project_meta_boxes_nonce'], 'project_meta_boxes' ) ) {
			return $post_id;
		}

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return false;
        }

        $subtitle = sanitize_text_field($_POST['project-subtitle']);
        $description = sanitize_textarea_field($_POST['project-description']);
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
        update_post_meta($post_id, '_genosha_project_content', maybe_serialize($data));
    }
}
