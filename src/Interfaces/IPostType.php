<?php

namespace Gen\Api\Interfaces;

interface IPostType
{
    public function post_type();
    public function taxonomies();
    public function gutenber($use_gutenberg, $post);
}