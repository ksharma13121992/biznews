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
class People_Post_Type_Registrations {

	public $post_type = 'people';

	public $taxonomies = array( 'people-category');

	public function init() {
		// Add the peoplepost type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses People_Post_Type_Registrations::register_post_type()
	 * @uses People_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_people_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'People', 'biznews' ),
			'singular_name'      => __( 'People', 'biznews' ),
			'add_new'            => __( 'Add People', 'biznews' ),
			'add_new_item'       => __( 'Add People', 'biznews' ),
			'edit_item'          => __( 'Edit People', 'biznews' ),
			'new_item'           => __( 'New People', 'biznews' ),
			'view_item'          => __( 'View People', 'biznews' ),
			'search_items'       => __( 'Search People', 'biznews' ),
			'not_found'          => __( 'No People found', 'biznews' ),
			'not_found_in_trash' => __( 'No People in the trash', 'biznews' ),
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
			'rewrite'         => array( 'slug' => 'people', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-id',
		);

		$args = apply_filters( 'people_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	protected function register_people_category() {
		$labels = array(
			'name'                       => __( 'People Category Type', 'biznews' ),
			'singular_name'              => __( 'People Category Type', 'biznews' ),
			'menu_name'                  => __( 'People Category Type', 'biznews' ),
			'edit_item'                  => __( 'Edit People Category Type', 'biznews' ),
			'update_item'                => __( 'Update People Category Type', 'biznews' ),
			'add_new_item'               => __( 'Add New People Category Type', 'biznews' ),
			'new_item_name'              => __( 'New People Category Type Name', 'biznews' ),
			'parent_item'                => __( 'Parent People Category Type', 'biznews' ),
			'parent_item_colon'          => __( 'Parent People Category Type:', 'biznews' ),
			'all_items'                  => __( 'All People Category Types', 'biznews' ),
			'search_items'               => __( 'Search People Category Types', 'biznews' ),
			'popular_items'              => __( 'Popular People Category Type', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate People Category Type with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove People Category Type', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used People Category Types', 'biznews' ),
			'not_found'                  => __( 'No People Category Type found.', 'biznews' ),
		);
		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'people-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'biznews_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
	
}
