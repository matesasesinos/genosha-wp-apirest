<?php

namespace Gen\Api\Repositories;

class MediaRepository
{
    public static function upload_file($file, array $mime_type)
    {
        $check_type = wp_check_filetype($file['name'])['type'];

        if(sizeof($mime_type) != 0 && !in_array($check_type, $mime_type)) {
            return new \WP_Error('mime_type_error', 'Archivo no permitido.');
        }

        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }

        $upload_overrides = array(
            'test_form' => false
        );
        $upload = wp_handle_upload($file, $upload_overrides );

        if(isset($upload['error']) && $upload['error'] != 0) {
            return new \WP_Error('upload_error', $upload['error']);
        }

        return $upload;
    }
}
