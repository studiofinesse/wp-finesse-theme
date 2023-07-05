<?php

// Define constants
define( 'THEME', get_template_directory_uri() );
define( 'THEME_DIR', __DIR__ );
define( 'IMG', THEME . '/img' );
define( 'IMG_DIR', THEME_DIR . '/img' );
define( 'STYLES', THEME . '/dist' );
define( 'JS', THEME . '/dist' );

require THEME_DIR . '/app/config.php';

require THEME_DIR . '/app/helpers.php';
require THEME_DIR . '/app/admin.php';
require THEME_DIR . '/app/media.php';
require THEME_DIR . '/app/nav-menus.php';
require THEME_DIR . '/app/scripts.php';

require THEME_DIR . '/app/acf/acf-config.php';