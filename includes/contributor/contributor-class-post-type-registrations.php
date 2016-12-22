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
class Contributor_Post_Type_Registrations {

	public $post_type = 'contributor';

	public $taxonomies = array( 'contributor-category');

	public function init() {
		// Add the contributorpost type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Contributor_Post_Type_Registrations::register_post_type()
	 * @uses Contributor_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_contributor_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Contributor', 'biznews' ),
			'singular_name'      => __( 'Contributor', 'biznews' ),
			'add_new'            => __( 'Add Contributor', 'biznews' ),
			'add_new_item'       => __( 'Add Contributor', 'biznews' ),
			'edit_item'          => __( 'Edit Contributor', 'biznews' ),
			'new_item'           => __( 'New Contributor', 'biznews' ),
			'view_item'          => __( 'View Contributor', 'biznews' ),
			'search_items'       => __( 'Search Contributor', 'biznews' ),
			'not_found'          => __( 'No Contributor found', 'biznews' ),
			'not_found_in_trash' => __( 'No Contributor in the trash', 'biznews' ),
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
			'rewrite'         => array( 'slug' => 'contributor', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-id',
		);

		$args = apply_filters( 'contributor_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	protected function register_contributor_category() {
		$labels = array(
			'name'                       => __( 'Contributor Category Type', 'biznews' ),
			'singular_name'              => __( 'Contributor Category Type', 'biznews' ),
			'menu_name'                  => __( 'Contributor Category Type', 'biznews' ),
			'edit_item'                  => __( 'Edit Contributor Category Type', 'biznews' ),
			'update_item'                => __( 'Update Contributor Category Type', 'biznews' ),
			'add_new_item'               => __( 'Add New Contributor Category Type', 'biznews' ),
			'new_item_name'              => __( 'New Contributor Category Type Name', 'biznews' ),
			'parent_item'                => __( 'Parent Contributor Category Type', 'biznews' ),
			'parent_item_colon'          => __( 'Parent Contributor Category Type:', 'biznews' ),
			'all_items'                  => __( 'All Contributor Category Types', 'biznews' ),
			'search_items'               => __( 'Search Contributor Category Types', 'biznews' ),
			'popular_items'              => __( 'Popular Contributor Category Type', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Contributor Category Type with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Contributor Category Type', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Contributor Category Types', 'biznews' ),
			'not_found'                  => __( 'No Contributor Category Type found.', 'biznews' ),
		);
		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'contributor-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'biznews_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
	
}
