<?php

add_action( 'after_setup_theme', function() {
	register_nav_menus( [
		'primary-navigation' => 'Primary Navigation',
		'footer-navigation' => 'Footer Navigation',
		'legal-links' => 'Legal Links',
	] );
}, 0 );