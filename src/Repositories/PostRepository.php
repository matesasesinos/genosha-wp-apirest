<?php

namespace Gen\Api\Repositories;

class PostRepository
{
    public static function count(string $type)
    {
        return wp_count_posts($type);
    }

    public static function get_all_posts(array $args, string $terms_key, string $taxonomy, string $meta)
    {
        $posts = [];

        foreach (get_posts($args) as $post) {
            $data = [
                'ID' => $post->ID,
                'title' => $post->post_title,
                'meta_desc' => get_post_meta($post->ID, '_yoast_wpseo_metadesc', true),
                'og_title' => get_post_meta($post->ID, '_yoast_wpseo_opengraph-title', true),
                'og_description' => get_post_meta($post->ID, '_yoast_wpseo_opengraph-description', true),
                'og_image' => get_post_meta($post->ID, '_yoast_wpseo_opengraph-image', true),
                'og_tw_title' => get_post_meta($post->ID, '_yoast_wpseo_twitter-title', true),
                'og_tw_description' => get_post_meta($post->ID, '_yoast_wpseo_twitter-description', true),
                'og_tw_image' => get_post_meta($post->ID, '_yoast_wpseo_twitter-image', true),
            ];
            if($post->post_content != '') {
                $data['content'] = $post->post_content;
            }
            //Metas
            if($meta != null || $meta != '') {
                $data['meta'] = [];
                array_push($data['meta'], self::get_postmeta($post->ID,$meta));
            }
            //Terms
            if ($taxonomy != null || $taxonomy != '') {
                $data[$terms_key] = [];
                array_push($data[$terms_key], self::get_terms($post->ID, $taxonomy));
            }
            
            array_push($posts, $data);
        }

        return $posts;
    }

    public static function get(int $post_id)
    {
        return get_post($post_id);
    }

    public static function get_terms(int $post_id, string $taxonomy)
    {
        $terms = [];
        foreach (get_the_terms($post_id, $taxonomy) as $term) {
            array_push($terms, $term->name);
        }

        return $terms;
    }

    public static function get_postmeta(int $post_id, string $meta)
    {
        return is_serialized( get_post_meta($post_id,$meta,true) ) ? maybe_unserialize( get_post_meta($post_id,$meta,true) ) : get_post_meta($post_id,$meta,true);
    }
}
