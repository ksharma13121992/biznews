<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://atidiv.com
 * @since             1.0.0
 * @package           Biznews
 *
 * @wordpress-plugin
 * Plugin Name:       biznews
 * Plugin URI:        https://github.com/ksharma13121992/biznews
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Atidiv
 * Author URI:        http://atidiv.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       biznews
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/biznews-post-type.php';

/****************************************
**********Companies post type*************
****************************************/
require plugin_dir_path( __FILE__ ) . 'includes/companies/companies-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/companies/companies-post-type-metaboxes.php';
// Instantiate registration class, so we can add it as a dependency to main plugin class.
$companies_post_type_registrations = new Companies_Post_Type_Registrations;
// Instantiate main plugin file, so activation callback does not need to be static.
$companies_post_type = new Biznews_Post_Type( $companies_post_type_registrations );
// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $companies_post_type, 'activate' ) );
// Initialize registrations for post-activation requests.
$companies_post_type_registrations->init();
// Initialize metaboxes
$companies_post_type_metaboxes = new Companies_Post_Type_Metaboxes;
$companies_post_type_metaboxes->init();
/**
 * Adds styling to the dashboard for the post type and adds investment posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/biznews-dashboard-glancer.php';  // WP 3.8
	}
	require plugin_dir_path( __FILE__ ) . 'includes/companies/companies-post-type-admin.php';
	$companies_post_type_admin = new Companies_Post_Type_Admin( $companies_post_type_registrations );
	$companies_post_type_admin->init();
}

/****************************************
**********Projects post type*************
****************************************/
require plugin_dir_path( __FILE__ ) . 'includes/projects/project-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/projects/project-post-type-metaboxes.php';
// Instantiate registration class, so we can add it as a dependency to main plugin class.
$project_post_type_registrations = new Project_Post_Type_Registrations;
// Instantiate main plugin file, so activation callback does not need to be static.
$project_post_type = new Biznews_Post_Type( $project_post_type_registrations );
// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $project_post_type, 'activate' ) );
// Initialize registrations for post-activation requests.
$project_post_type_registrations->init();
// Initialize metaboxes
$project_post_type_metaboxes = new Project_Post_Type_Metaboxes;
$project_post_type_metaboxes->init();
/**
 * Adds styling to the dashboard for the post type and adds investment posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {
	require plugin_dir_path( __FILE__ ) . 'includes/projects/project-post-type-admin.php';
	$project_post_type_admin = new Project_Post_Type_Admin( $project_post_type_registrations );
	$project_post_type_admin->init();
}