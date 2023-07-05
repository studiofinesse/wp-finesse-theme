<?php

/*
* Enqueue all the necessary theme scripts and stylesheets
*/
add_action( 'wp_enqueue_scripts', 'sf_enqueue_scripts', 11 );

function sf_enqueue_scripts() {
	wp_enqueue_style(
		'main',
		STYLES . '/main.css',
		null,
		// false,
		@filemtime( THEME_DIR . '/dist/main.css' ),
		false
	);
	
	wp_enqueue_script(
		'functions',
		JS . '/functions.js',
		null,
		// false,
		@filemtime( THEME_DIR . '/dist/functions.js' ),
		true
	);
}

/*
* Remove all default WordPress CSS
*/
add_action( 'wp_enqueue_scripts', function() {
	wp_dequeue_style( 'wp-block-library' ); // remove Gutenberg CSS
	wp_deregister_style( 'classic-theme-styles' );
	wp_dequeue_style( 'classic-theme-styles-css' );
	
	// If used, move jQuery to footer
	// wp_scripts()->add_data( 'jquery', 'group', 1 );
	// wp_scripts()->add_data( 'jquery-core', 'group', 1 );
	// wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
}, 11 );