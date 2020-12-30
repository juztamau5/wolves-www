<?php
/***
* Jobs Post Type
***/

if(! class_exists('Progressive_Jobs_Post_Type')):
class Progressive_Jobs_Post_Type{

	function __construct(){
		// Adds the jobs post type and taxonomies
		add_action('init',array(&$this,'jobs_init'),0);
		// Thumbnail support for jobs posts
		add_theme_support('post-thumbnails',array('jobs'));
	}

	function jobs_init(){
		/**
		 * Enable the Jobs_init custom post type
		 * http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		$labels = array(
			'name'					=> __('Jobs','Progressive'),
			'singular_name'		=> __('Job Name','Progressive'),
			'add_new'				=> __('Add New','Progressive'),
			'add_new_item'			=> __('Add New Job','Progressive'),
			'edit_item'			=> __('Edit Job','Progressive'),
			'new_item'				=> __('Add New Job','Progressive'),
			'view_item'			=> __('View Job','Progressive'),
			'search_items'			=> __('Search Jobs','Progressive'),
			'not_found'			=> __('No jobs items found','Progressive'),
			'not_found_in_trash'	=> __('No jobs found in trash','Progressive')
		);
		
		$args = array(
		    'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon' => 'dashicons-id',
			'rewrite' => true,			
			'map_meta_cap' => true,
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array('title','thumbnail','editor','page-attributes')
		); 
		
		$args = apply_filters('Progressive_jobs_args',$args);
		register_post_type('jobs',$args);
	}
}
new Progressive_Jobs_Post_Type;
endif;