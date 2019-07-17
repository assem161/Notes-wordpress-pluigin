<?php

if(is_admin()){
	function Notes_admin_scripts() {
		wp_enqueue_style('s-admin-notes-styles',plugins_url().'/Notes/css/sminstyle.css');
		wp_enqueue_script( 's-admin-notes-mainjs', plugins_url() . '/Notes/js/sminmain.js', true );
	}
	add_action( 'admin_init', 'Notes_admin_scripts' );
}

function Notes_scripts() {
	wp_enqueue_style('s-notes-styles',plugins_url().'/Notes/css/sNstyle.css');
	wp_enqueue_script( 's-notes-mainjs', plugins_url() . '/Notes/js/sNmain.js', true );
}
add_action( 'wp_enqueue_scripts', 'Notes_scripts' );