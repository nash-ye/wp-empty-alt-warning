<?php
/*
Plugin Name: Empty Alt Warning
Plugin URI: https://github.com/nash-ye/wp-empty-alt-warning
Description: A simple plugin to warn authors when an image with empty alt attribute inserted.
Author: Nashwan Doaqan
Author URI: http://nashwan-d.com
Version: 0.1.1
*/

add_action( 'admin_enqueue_scripts', 'eaw_admin_register_scripts' );

/**
 * @return void
 * @since 0.1
 */
function eaw_admin_register_scripts() {
	wp_register_script( 'eaw-media-editor-addon', plugin_dir_url(__FILE__ ) . 'js/media-editor-addon.js', array( 'jquery', 'media-editor' ), '0.1', true );
}

add_action( 'admin_enqueue_scripts', 'eaw_admin_enqueue_scripts', 1000 );

/**
 * @return void
 * @since 0.1
 */
function eaw_admin_enqueue_scripts() {
	if ( wp_script_is( 'media-editor', 'enqueued' ) ) {
		wp_enqueue_script( 'eaw-media-editor-addon' );
	}
}
