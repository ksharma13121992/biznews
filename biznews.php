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
**********Projects post type*************
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

	$people_post_type_admin = new People_Post_Type_Admin( $people_post_type_registrations );
	$people_post_type_admin->init();

}
/****************************************
**********Location post type*************
****************************************/
// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/location/location-class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/location/location-class-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/location/location-class-post-type-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$location_post_type_registrations = new Location_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$location_post_type = new Location_Post_Type( $location_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $location_post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$location_post_type_registrations->init();

// Initialize metaboxes
$location_post_type_metaboxes = new Location_Post_Type_Metaboxes;
$location_post_type_metaboxes->init();


/**
 * Adds styling to the dashboard for the post type and adds investment posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/location/location-class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/location/location-class-post-type-admin.php';

	$location_post_type_admin = new Location_Post_Type_Admin( $location_post_type_registrations );
	$location_post_type_admin->init();

}
/****************************************
**********Event post type*************
****************************************/
// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/event/event-class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/event/event-class-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/event/event-class-post-type-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$event_post_type_registrations = new Event_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$event_post_type = new Event_Post_Type( $event_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $event_post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$event_post_type_registrations->init();

// Initialize metaboxes
$event_post_type_metaboxes = new Event_Post_Type_Metaboxes;
$event_post_type_metaboxes->init();


/**
 * Adds styling to the dashboard for the post type and adds investment posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/event/event-class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/event/event-class-post-type-admin.php';

	$event_post_type_admin = new Event_Post_Type_Admin( $event_post_type_registrations );
	$event_post_type_admin->init();

}
/****************************************
**********Acquisition post type*************
****************************************/
// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/acquisition/acquisition-class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/acquisition/acquisition-class-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/acquisition/acquisition-class-post-type-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$acquisition_post_type_registrations = new Acquisition_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$acquisition_post_type = new Acquisition_Post_Type( $acquisition_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $acquisition_post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$acquisition_post_type_registrations->init();

// Initialize metaboxes
$acquisition_post_type_metaboxes = new Acquisition_Post_Type_Metaboxes;
$acquisition_post_type_metaboxes->init();


/**
 * Adds styling to the dashboard for the post type and adds investment posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/acquisition/acquisition-class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/acquisition/acquisition-class-post-type-admin.php';

	$acquisition_post_type_admin = new Acquisition_Post_Type_Admin( $acquisition_post_type_registrations );
	$acquisition_post_type_admin->init();

}
/****************************************
**********Award post type*************
****************************************/
// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/award/award-class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/award/award-class-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/award/award-class-post-type-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$award_post_type_registrations = new Award_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$award_post_type = new Award_Post_Type( $award_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $award_post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$award_post_type_registrations->init();

// Initialize metaboxes
$award_post_type_metaboxes = new Award_Post_Type_Metaboxes;
$award_post_type_metaboxes->init();


/**
 * Adds styling to the dashboard for the post type and adds investment posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/award/award-class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/award/award-class-post-type-admin.php';

	$award_post_type_admin = new Award_Post_Type_Admin( $award_post_type_registrations );
	$award_post_type_admin->init();

}
/****************************************
**********Funding Round Post Type*******
****************************************/
// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/fundinground/fundinground-class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/fundinground/fundinground-class-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/fundinground/fundinground-class-post-type-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$fundinground_post_type_registrations = new Fundinground_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$fundinground_post_type = new Fundinground_Post_Type( $fundinground_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $fundinground_post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$fundinground_post_type_registrations->init();

// Initialize metaboxes
$fundinground_post_type_metaboxes = new Fundinground_Post_Type_Metaboxes;
$fundinground_post_type_metaboxes->init();


/**
 * Adds styling to the dashboard for the post type and adds investment posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/fundinground/fundinground-class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/fundinground/fundinground-class-post-type-admin.php';

	$fundinground_post_type_admin = new Fundinground_Post_Type_Admin( $fundinground_post_type_registrations );
	$fundinground_post_type_admin->init();

}
/****************************************
**********Contributor Post Type*******
****************************************/
// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/contributor/contributor-class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/contributor/contributor-class-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/contributor/contributor-class-post-type-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$contributor_post_type_registrations = new Contributor_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$contributor_post_type = new Contributor_Post_Type( $contributor_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $contributor_post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$contributor_post_type_registrations->init();

// Initialize metaboxes
$contributor_post_type_metaboxes = new Contributor_Post_Type_Metaboxes;
$contributor_post_type_metaboxes->init();


/**
 * Adds styling to the dashboard for the post type and adds investment posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/contributor/contributor-class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/contributor/contributor-class-post-type-admin.php';

	$contributor_post_type_admin = new Contributor_Post_Type_Admin( $contributor_post_type_registrations );
	$contributor_post_type_admin->init();

}