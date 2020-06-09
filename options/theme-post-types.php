<?php

add_action('init', 'theme_register_post_types');
function theme_register_post_types() {

	$labels = array(
		'name' => _x('Slides', 'post type general name'),
		'singular_name' => _x('Slide', 'post type singular name'),
		'add_new' => _x('Add New', 'Slide'),
		'add_new_item' => __('Add New Slide'),
		'edit_item' => __('Edit Slide'),
		'new_item' => __('New Slide'),
		'view_item' => __('View Slide'),
		'search_items' => __('Search Slides'),
		'not_found' =>  __('No Slides found'),
		'not_found_in_trash' => __('No Slides found in Trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','author')
	); 
	register_post_type('slides', $args);


	$labels = array(
		'name' => _x('Tryouts Managment', 'post type general name'),
		'singular_name' => _x('Tryout', 'post type singular name'),
		'add_new' => _x('Add New', 'Tryout'),
		'add_new_item' => __('Add New Tryout'),
		'edit_item' => __('Edit Tryout'),
		'new_item' => __('New Tryout'),
		'view_item' => __('View Tryout'),
		'search_items' => __('Search Tryouts'),
		'not_found' =>  __('No Tryouts found'),
		'not_found_in_trash' => __('No Tryouts found in Trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','author', 'page-attributes',),
	); 
	register_post_type('tryouts', $args);
}
?>