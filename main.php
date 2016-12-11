<?php
/*
Plugin Name: Empty Alt Warning
Plugin URI: https://github.com/nash-ye/wp-empty-alt-warning
Description: A simple plugin to warn authors when an image with empty alternative text inserted.
Author: Nashwan Doaqan
Author URI: http://nashwan-d.com
Version: 0.1.4
*/

add_action( 'plugins_loaded', 'eaw_setup' );

/**
 * @return void
 * @since 0.1.4
 */
function eaw_setup() {
	eaw_load_textdomain();

	add_action( 'admin_enqueue_scripts', 'eaw_admin_register_scripts' );
	add_action( 'admin_enqueue_scripts', 'eaw_admin_enqueue_scripts', 1000 );
}

/**
 * @return void
 * @since 0.1.4
 */
function eaw_load_textdomain() {
	load_plugin_textdomain( 'empty-alt-warning', false, dirname( plugin_basename( __FILE__ ) ) . '/locales' );
}

/**
 * @return void
 * @since 0.1
 */
function eaw_admin_register_scripts() {
	wp_register_script( 'eaw-media-editor-addon', plugin_dir_url(__FILE__ ) . 'js/media-editor-addon.js', array( 'jquery', 'media-editor' ), '0.1', true );
}

/**
 * @return void
 * @since 0.1
 */
function eaw_admin_enqueue_scripts() {
	if ( wp_script_is( 'media-editor', 'enqueued' ) ) {
		wp_enqueue_script( 'eaw-media-editor-addon' );
		wp_localize_script( 'eaw-media-editor-addon', 'emptyAltWarningSettings', array(
			'warningText' => __( "You have not provided any alternative text. Insert image anyway?", 'empty-alt-warning' ),
		) );
	}
}
