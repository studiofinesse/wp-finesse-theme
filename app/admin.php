<?php

/**
 * Make adjustments to the admin menu
 */
add_action( 'admin_menu', function() {
	global $menu;

	// Change icon of the Media menu item - for no real reason
	$menu[10][6] = 'dashicons-format-gallery';

	// Move the Media menu item
	$media = $menu[10];
	$menu[58] = $media;
	unset( $menu[10] );
} );

/**
 * Disable various dashboard widgets
 */
add_action( 'admin_init', function() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' ); // Removes the 'incoming links' widget
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' ); // Removes the 'plugins' widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' ); // Removes the 'WordPress News' widget
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' ); // Removes the secondary widget
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Removes the 'Quick Draft' widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' ); // Removes the 'Recent Drafts' widget
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); // Removes the 'Activity' widget
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Removes the 'Activity' widget (since 3.8)
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // Removes the 'At a Glance' widget
} );