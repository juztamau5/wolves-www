<?php
/***
* Team Members Post Type
***/

if(! class_exists('Progressive_Team_Members_Post_Type')):
class Progressive_Team_Members_Post_Type{

	function __construct(){
		// Adds the team_members post type and taxonomies
		add_action('init',array(&$this,'team_members_init'),0);
		// Thumbnail support for team_members posts
		add_theme_support('post-thumbnails',array('team_members'));
	}

	function team_members_init(){
		/**
		 * Enable the Team Members_init custom post type
		 * http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		$labels = array(
			'name'					=> __('Team Members','Progressive'),
			'singular_name'		=> __('Team Member Name','Progressive'),
			'add_new'				=> __('Add New','Progressive'),
			'add_new_item'			=> __('Add New Team Member','Progressive'),
			'edit_item'			=> __('Edit Team Member','Progressive'),
			'new_item'				=> __('Add New Team Member','Progressive'),
			'view_item'			=> __('View Team Member','Progressive'),
			'search_items'			=> __('Search Team Members','Progressive'),
			'not_found'			=> __('No Team Members found','Progressive'),
			'not_found_in_trash'	=> __('No Team Members found in trash','Progressive')
		);
		
		$args = array(
		    'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon' => 'dashicons-groups',
			'rewrite' => true,			
			'map_meta_cap' => true,
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array('title','editor','thumbnail','page-attributes')
		); 
		
		$args = apply_filters('Progressive_team_members_args',$args);
		register_post_type('team_members',$args);
	}
}
new Progressive_Team_Members_Post_Type;
endif;