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
class Acquisition_Post_Type_Registrations {

	public $post_type = 'acquisition';

	public $taxonomies = array( 'acquisition-category');

	public function init() {
		// Add the acquisitionpost type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Acquisition_Post_Type_Registrations::register_post_type()
	 * @uses Acquisition_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_acquisition_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Acquisition', 'biznews' ),
			'singular_name'      => __( 'Acquisition', 'biznews' ),
			'add_new'            => __( 'Add Acquisition', 'biznews' ),
			'add_new_item'       => __( 'Add Acquisition', 'biznews' ),
			'edit_item'          => __( 'Edit Acquisition', 'biznews' ),
			'new_item'           => __( 'New Acquisition', 'biznews' ),
			'view_item'          => __( 'View Acquisition', 'biznews' ),
			'search_items'       => __( 'Search Acquisition', 'biznews' ),
			'not_found'          => __( 'No Acquisition found', 'biznews' ),
			'not_found_in_trash' => __( 'No Acquisition in the trash', 'biznews' ),
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
			'rewrite'         => array( 'slug' => 'acquisition', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-id',
		);

		$args = apply_filters( 'acquisition_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	protected function register_acquisition_category() {
		$labels = array(
			'name'                       => __( 'Acquisition Category Type', 'biznews' ),
			'singular_name'              => __( 'Acquisition Category Type', 'biznews' ),
			'menu_name'                  => __( 'Acquisition Category Type', 'biznews' ),
			'edit_item'                  => __( 'Edit Acquisition Category Type', 'biznews' ),
			'update_item'                => __( 'Update Acquisition Category Type', 'biznews' ),
			'add_new_item'               => __( 'Add New Acquisition Category Type', 'biznews' ),
			'new_item_name'              => __( 'New Acquisition Category Type Name', 'biznews' ),
			'parent_item'                => __( 'Parent Acquisition Category Type', 'biznews' ),
			'parent_item_colon'          => __( 'Parent Acquisition Category Type:', 'biznews' ),
			'all_items'                  => __( 'All Acquisition Category Types', 'biznews' ),
			'search_items'               => __( 'Search Acquisition Category Types', 'biznews' ),
			'popular_items'              => __( 'Popular Acquisition Category Type', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Acquisition Category Type with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Acquisition Category Type', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Acquisition Category Types', 'biznews' ),
			'not_found'                  => __( 'No Acquisition Category Type found.', 'biznews' ),
		);
		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'acquisition-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'biznews_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
	
}
