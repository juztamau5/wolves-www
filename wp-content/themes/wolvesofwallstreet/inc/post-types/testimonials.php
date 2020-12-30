<?php
/***
* Banners Post Type
***/

if(! class_exists('arc_Banners_Post_Type')):
class arc_Banners_Post_Type{

	function __construct(){
		// Adds the Banners post type and taxonomies
		add_action('init',array(&$this,'banners_init'),0);
		// Thumbnail support for Banners posts
		add_theme_support('post-thumbnails',array('banners'));
	}

	function banners_init(){
		/**
		 * Enable the Banners_init custom post type
		 * http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		$labels = array(
			'name'					=> __('Banners','arc'),
			'singular_name'		=> __('Banners Name','arc'),
			'add_new'				=> __('Add New','arc'),
			'add_new_item'			=> __('Add New Banners','arc'),
			'edit_item'			=> __('Edit Banner','arc'),
			'new_item'				=> __('Add New Banner','arc'),
			'view_item'			=> __('View Banner','arc'),
			'search_items'			=> __('Search Banners','arc'),
			'not_found'			=> __('No banners items found','arc'),
			'not_found_in_trash'	=> __('No banners found in trash','arc')
		);
		
		$args = array(
		    'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon' => 'dashicons-testimonial',
			'rewrite' => true,			
			'map_meta_cap' => true,
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array('title','editor','thumbnail','page-attributes')
		); 
		
		$args = apply_filters('arc_banners_args',$args);
		register_post_type('banners',$args);
	}
}
new arc_Banners_Post_Type;
endif;