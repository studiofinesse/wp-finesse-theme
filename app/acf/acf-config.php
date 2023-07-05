<?php

if ( ! class_exists( 'ACF' ) ) {
	return;
}

/**
 * Define ACF local save directory
 */
add_filter( 'acf/settings/save_json', function( $path ) {
	$path = THEME_DIR . '/app/acf/fields';

	return $path;
} );

/**
 * Define ACF local load directory
 */
add_filter( 'acf/settings/load_json', function( $paths ) {
	unset( $paths[0] );
	$paths[] = THEME_DIR . '/app/acf/fields';

	return $paths;
} );

/**
 * Ensure only admins can access ACF
 */
add_filter( 'acf/settings/capability', function( $path ) {
	return 'administrator';
} );

/**
 * Add custom toolbar sets to ACF WYSIWYG field
 */
add_filter( 'acf/fields/wysiwyg/toolbars', function( $toolbars ) {
	$toolbars['Essentials' ] = [];
	$toolbars['Essentials' ][1] = ['bold' , 'italic' , 'underline', 'link'];

	$toolbars['Simplified'] = [];
	$toolbars['Simplified'][1] = ['bold' , 'italic' , 'underline', 'strikethrough', 'link', 'bullist', 'numlist'];
	$toolbars['Simplified'][2] = ['formatselect', 'styleselect', 'pastetext', 'removeformat'];

	return $toolbars;
} );