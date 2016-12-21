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

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-biznews-activator.php
 */
function activate_biznews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-biznews-activator.php';
	Biznews_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-biznews-deactivator.php
 */
function deactivate_biznews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-biznews-deactivator.php';
	Biznews_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_biznews' );
register_deactivation_hook( __FILE__, 'deactivate_biznews' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-biznews.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_biznews() {

	$plugin = new Biznews();
	$plugin->run();

}
run_biznews();

/****************************************
**********Companies post type*************
****************************************/
// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/companies/company-class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/companies/company-class-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/companies/company-class-post-type-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$post_type_registrations = new Companies_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$post_type = new Company_Post_Type( $post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$post_type_registrations->init();

// Initialize metaboxes
$post_type_metaboxes = new Companies_Post_Type_Metaboxes;
$post_type_metaboxes->init();


/**
 * Adds styling to the dashboard for the post type and adds investment posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/companies/company-class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/companies/company-class-post-type-admin.php';

	$post_type_admin = new Companies_Post_Type_Admin( $post_type_registrations );
	$post_type_admin->init();

}
/****************************************
**********rojects post type*************
****************************************/
require plugin_dir_path( __FILE__ ) . 'includes/project/project-class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/project/project-class-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/project/project-class-post-type-metaboxes.php';
// Instantiate registration class, so we can add it as a dependency to main plugin class.
$project_post_type_registrations = new Project_Post_Type_Registrations;
// Instantiate main plugin file, so activation callback does not need to be static.
$project_post_type = new Project_Post_Type( $project_post_type_registrations );
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

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/project/project-class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/project/project-class-post-type-admin.php';

	$post_type_admin = new Project_Post_Type_Admin( $post_type_registrations );
	$post_type_admin->init();

}
/****************************************
**********People post type*************
****************************************/
// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/people/people-class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/people/people-class-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/people/people-class-post-type-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$people_post_type_registrations = new People_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$people_post_type = new People_Post_Type( $people_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $people_post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$people_post_type_registrations->init();

// Initialize metaboxes
$people_post_type_metaboxes = new People_Post_Type_Metaboxes;
$people_post_type_metaboxes->init();


/**
 * Adds styling to the dashboard for the post type and adds investment posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/people/people-class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/people/people-class-post-type-admin.php';

	$people_post_type_admin = new Companies_Post_Type_Admin( $people_post_type_registrations );
	$people_post_type_admin->init();

}