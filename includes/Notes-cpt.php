<?php

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function codex_Notes_init() {
	$singulername = apply_filters('NTL_label_single','Note');
	$pularname	  = apply_filters('NTL_label_single','Notes');	
	$labels = array(
		'name'               => _x( $singulername, 'post type'.$singulername, $singulername.'-textdomain' ),
		'singular_name'      => _x( $singulername, 'post type singular name', $singulername.'-textdomain' ),
		'menu_name'          => _x( $pularname, 'admin menu', $singulername.'-textdomain' ),
		'name_admin_bar'     => _x( $singulername, 'add new on admin bar', $singulername.'-textdomain' ),
		'add_new'            => _x( 'Add New', $singulername, $singulername.'-textdomain' ),
		'add_new_item'       => __( 'Add New '.$singulername, $singulername.'-textdomain' ),
		'new_item'           => __( 'New '.$singulername, $singulername.'-textdomain' ),
		'edit_item'          => __( 'Edit '.$singulername, $singulername.'-textdomain' ),
		'view_item'          => __( 'View '.$singulername, $singulername.'-textdomain' ),
		'all_items'          => __( 'All '.$pularname, $singulername.'-textdomain' ),
		'search_items'       => __( 'Search '.$pularname, $singulername.'-textdomain' ),
		'parent_item_colon'  => __( 'Parent '.$pularname.':', $singulername.'-textdomain' ),
		'not_found'          => __( 'No' .$pularname. 'found.', $singulername.'-textdomain' ),
		'not_found_in_trash' => __( 'No' .$pularname. 'found in Trash.', $singulername.'-textdomain')
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', $singulername.'-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $singulername ),
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title' ),
		'taxonomies'		 =>array('category'),
		'menu_icon'          => 'dashicons-format-quote'
	);

	register_post_type( 'Notes', $args );
}

add_action( 'init', 'codex_Notes_init' );