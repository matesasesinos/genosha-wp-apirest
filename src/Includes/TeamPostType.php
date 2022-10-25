<?php

// namespace Gen\Api\Includes;

// class TeamPostType
// {
//     function cptui_register_my_cpts_team() {

// 	/**
// 	 * Post Type: Equipo Genosha.
// 	 */

// 	$labels = [
// 		"name" => esc_html__( "Equipo Genosha", "tiny" ),
// 		"singular_name" => esc_html__( "Equipos", "tiny" ),
// 		"all_items" => esc_html__( "Equipo Genosha", "tiny" ),
// 	];

// 	$args = [
// 		"label" => esc_html__( "Equipo Genosha", "tiny" ),
// 		"labels" => $labels,
// 		"description" => "",
// 		"public" => true,
// 		"publicly_queryable" => true,
// 		"show_ui" => true,
// 		"show_in_rest" => true,
// 		"rest_base" => "",
// 		"rest_controller_class" => "WP_REST_Posts_Controller",
// 		"rest_namespace" => "wp/v2",
// 		"has_archive" => false,
// 		"show_in_menu" => false,
// 		"show_in_nav_menus" => true,
// 		"delete_with_user" => false,
// 		"exclude_from_search" => false,
// 		"capability_type" => "post",
// 		"map_meta_cap" => true,
// 		"hierarchical" => false,
// 		"can_export" => false,
// 		"rewrite" => [ "slug" => "team", "with_front" => true ],
// 		"query_var" => true,
// 		"supports" => [ "title", "thumbnail" ],
// 		"show_in_graphql" => true,
// 		"graphql_single_name" => "Equipo",
// 		"graphql_plural_name" => "Equipos",
// 	];

// 	register_post_type( "team", $args );
// }

// add_action( 'init', 'cptui_register_my_cpts_team' );

// }