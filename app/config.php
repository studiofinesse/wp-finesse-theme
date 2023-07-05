<?php

function fin_initial_theme_config() {
	// Theme Support
	add_theme_support( 'title-tag' );// Title tag support
	add_theme_support( 'post-thumbnails' ); // Thumbnail support
	add_theme_support( 'html5', array(  // HTML5 support
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// add_theme_support(
	// 	'editor-color-palette',
	// 	[
	// 		[
	// 			'name' => '',
	// 			'slug' => '',
	// 			'color' => ''
	// 		]
	// 	]
	// );

	// Remove WP Head Info
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'index_rel_link' );

	// remove SVG and global styles
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );

	// remove wp_footer actions which add's global inline styles
	remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
  
	// remove render_block filters which adding unnecessary stuff
	remove_filter( 'render_block', 'wp_render_duotone_support' );
	remove_filter( 'render_block', 'wp_restore_group_inner_container' );
	remove_filter( 'render_block', 'wp_render_layout_support_flag' );
}

add_action( 'after_setup_theme', 'fin_initial_theme_config' );