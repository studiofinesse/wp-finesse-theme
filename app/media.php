<?php

add_action( 'after_setup_theme', function() {

	$sizes = [
		'sm' => '400',
		'md' => '900',
		'lg' => '1200',
		'xl' => '1600'
	];

	$ratios = [
		[16, 9],
		[3, 4],
		[1, 1]
	];

	foreach( $ratios as $ratio ) {
		foreach( $sizes as $label => $size ) {
			$x = $ratio[0];
			$y = $ratio[1];

			$w = $x > $y ? $size : (int) floor( $size * ( $x / $y ) );
			$h = $x < $y ? $size : (int) floor( $size * ( $y / $x ) );


			add_image_size( "{$x}x{$y}-$label", $w, $h, true );
		}
	}

	// Update default image sizes to something more usable
	update_option( 'thumbnail_size_w', $sizes['sm'] ); // thumbnail width
	update_option( 'thumbnail_size_h', 9999 ); // thumbnail height
	update_option( 'thumbnail_crop', 0 );
	update_option( 'medium_size_w', $sizes['md'] ); // medium width
	update_option( 'medium_size_h', 9999 ); // medium height
	update_option( 'large_size_w', $sizes['lg'] ); // large width
	update_option( 'large_size_h', 9999 ); // large height

	// Set default options for when inserting images from media library
	update_option( 'image_default_align', 'none' ); // Set default alingment to none
	update_option( 'image_default_link_type', 'none' ); // Set default link type to none
	update_option( 'image_default_size', 'large' ); // Set default insert size to large

} );

add_filter( 'intermediate_image_sizes', function( $sizes ) {
    return array_diff( $sizes, ['medium_large'] );
} );