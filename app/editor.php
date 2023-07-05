<?php

/**
 * Add custom editor stylesheet
 */
add_filter( 'mce_css', function( $mce_css ) {
	if( file_exists( STYLES . '/editor.css' ) ) {
		$mce_css .= ', ' . STYLES . '/editor.css';
	}
	
	return $mce_css;
} );

/**
 * Reveal the hidden "Styles" dropdown in the advanced toolbar
 */
add_filter( 'mce_buttons_2', function( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	
	return $buttons;
} );

/**
 * Modify the styles/formats available in the TinyMCE editor
 */
add_filter( 'tiny_mce_before_init', function( $args ) {
	// Manage block formats available in the WYSIWYG editor
	// Disable Heading 1
	$block_formats = [
		'Heading 2=h2',
		'Heading 3=h3',
		'Heading 4=h4',
		'Paragraph=p',
		'Pre=pre'
	];

	$args['block_formats'] = implode( ';', $block_formats );

	// Add custom style formats/classes to dropdown
	// Lead paragraphs, buttons, etc
	$args['style_formats'] = json_encode( [
		[
			'title' => 'Lead',
			'selector' => 'p',
			'classes' => 'lead'
		],
		[
			'title' => 'Button',
			'selector' => 'a',
			'classes' => 'btn',
		],
		[
			'title' => 'Citation',
			'block' => 'cite',
			'classes' => 'citation',
			'wrapper' => true
		],
	] );

	return $args;
} );

add_filter( 'acf/format_value/type=textarea', 'fin_format_markup', 10, 3 );
add_filter( 'acf/format_value/type=text', 'fin_format_markup', 10, 3 );

function fin_format_markup( $content ) {
	return preg_replace( '/\[\*(.+?)\*\]/', '<span class="highlighted">$1</span>', $content );
}