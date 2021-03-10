<?php
/*
Plugin Name:  WordPress Site Owner Role Plugin
Description:  WordPress plugin to create a 'Site Owner' role for WordPress sites.
Author:       Division of Diversity and Community Engagement
Author URI:  https://leroyrosales.com
Version:      1.0
Text Domain:  wordpress-site-owner-role
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

define( 'WP_OWNER_ROLE_PATH', plugin_dir_path( __FILE__ ) );

// include plugin dependencies
require_once WP_OWNER_ROLE_PATH . 'admin/set-role.php';
