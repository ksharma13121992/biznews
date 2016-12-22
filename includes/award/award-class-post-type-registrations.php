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
class Award_Post_Type_Registrations {

	public $post_type = 'award';

	public $taxonomies = array( 'award-category');

	public function init() {
		// Add the awardpost type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Award_Post_Type_Registrations::register_post_type()
	 * @uses Award_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_award_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Award', 'biznews' ),
			'singular_name'      => __( 'Award', 'biznews' ),
			'add_new'            => __( 'Add Award', 'biznews' ),
			'add_new_item'       => __( 'Add Award', 'biznews' ),
			'edit_item'          => __( 'Edit Award', 'biznews' ),
			'new_item'           => __( 'New Award', 'biznews' ),
			'view_item'          => __( 'View Award', 'biznews' ),
			'search_items'       => __( 'Search Award', 'biznews' ),
			'not_found'          => __( 'No Award found', 'biznews' ),
			'not_found_in_trash' => __( 'No Award in the trash', 'biznews' ),
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
			'rewrite'         => array( 'slug' => 'award', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-id',
		);

		$args = apply_filters( 'award_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	protected function register_award_category() {
		$labels = array(
			'name'                       => __( 'Award Category Type', 'biznews' ),
			'singular_name'              => __( 'Award Category Type', 'biznews' ),
			'menu_name'                  => __( 'Award Category Type', 'biznews' ),
			'edit_item'                  => __( 'Edit Award Category Type', 'biznews' ),
			'update_item'                => __( 'Update Award Category Type', 'biznews' ),
			'add_new_item'               => __( 'Add New Award Category Type', 'biznews' ),
			'new_item_name'              => __( 'New Award Category Type Name', 'biznews' ),
			'parent_item'                => __( 'Parent Award Category Type', 'biznews' ),
			'parent_item_colon'          => __( 'Parent Award Category Type:', 'biznews' ),
			'all_items'                  => __( 'All Award Category Types', 'biznews' ),
			'search_items'               => __( 'Search Award Category Types', 'biznews' ),
			'popular_items'              => __( 'Popular Award Category Type', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Award Category Type with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Award Category Type', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Award Category Types', 'biznews' ),
			'not_found'                  => __( 'No Award Category Type found.', 'biznews' ),
		);
		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'award-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'biznews_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
	
}
