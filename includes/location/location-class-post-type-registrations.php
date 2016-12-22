<?php
/**
 * Biznews
 *
 * @package   Biznews
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package Biznews
 */
class Location_Post_Type_Registrations {

	public $post_type = 'location';

	public $taxonomies = array( 'location-category');

	public function init() {
		// Add the locationpost type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Location_Post_Type_Registrations::register_post_type()
	 * @uses Location_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_location_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Location', 'biznews' ),
			'singular_name'      => __( 'Location', 'biznews' ),
			'add_new'            => __( 'Add Location', 'biznews' ),
			'add_new_item'       => __( 'Add Location', 'biznews' ),
			'edit_item'          => __( 'Edit Location', 'biznews' ),
			'new_item'           => __( 'New Location', 'biznews' ),
			'view_item'          => __( 'View Location', 'biznews' ),
			'search_items'       => __( 'Search Location', 'biznews' ),
			'not_found'          => __( 'No Location found', 'biznews' ),
			'not_found_in_trash' => __( 'No Location in the trash', 'biznews' ),
		);

		$supports = array(
			'title',
			 'editor', 
			'thumbnail',
			'custom-fields',
			'revisions',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'location', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-id',
		);

		$args = apply_filters( 'location_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	protected function register_location_category() {
		$labels = array(
			'name'                       => __( 'Location Category Type', 'biznews' ),
			'singular_name'              => __( 'Location Category Type', 'biznews' ),
			'menu_name'                  => __( 'Location Category Type', 'biznews' ),
			'edit_item'                  => __( 'Edit Location Category Type', 'biznews' ),
			'update_item'                => __( 'Update Location Category Type', 'biznews' ),
			'add_new_item'               => __( 'Add New Location Category Type', 'biznews' ),
			'new_item_name'              => __( 'New Location Category Type Name', 'biznews' ),
			'parent_item'                => __( 'Parent Location Category Type', 'biznews' ),
			'parent_item_colon'          => __( 'Parent Location Category Type:', 'biznews' ),
			'all_items'                  => __( 'All Location Category Types', 'biznews' ),
			'search_items'               => __( 'Search Location Category Types', 'biznews' ),
			'popular_items'              => __( 'Popular Location Category Type', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Location Category Type with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Location Category Type', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Location Category Types', 'biznews' ),
			'not_found'                  => __( 'No Location Category Type found.', 'biznews' ),
		);
		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'location-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'biznews_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
	
}
