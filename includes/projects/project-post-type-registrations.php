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
class Project_Post_Type_Registrations {

	public $post_type = 'project';

	public $taxonomies = array( 'project-category');

	public function init() {
		// Add the projectpost type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Project_Post_Type_Registrations::register_post_type()
	 * @uses Project_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Project', 'biznews' ),
			'singular_name'      => __( 'Project Member', 'biznews' ),
			'add_new'            => __( 'Add Project', 'biznews' ),
			'add_new_item'       => __( 'Add Project', 'biznews' ),
			'edit_item'          => __( 'Edit Project', 'biznews' ),
			'new_item'           => __( 'New project Member', 'biznews' ),
			'view_item'          => __( 'View Project', 'biznews' ),
			'search_items'       => __( 'Search project', 'biznews' ),
			'not_found'          => __( 'No Project found', 'biznews' ),
			'not_found_in_trash' => __( 'No Project in the trash', 'biznews' ),
		);

		$supports = array(
			'title',
			'thumbnail',
			'custom-fields',
			'revisions',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'project', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-id',
		);

		$args = apply_filters( 'project_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for project Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Project Category', 'biznews' ),
			'singular_name'              => __( 'Project Category', 'biznews' ),
			'menu_name'                  => __( 'Project Category', 'biznews' ),
			'edit_item'                  => __( 'Edit Project Category', 'biznews' ),
			'update_item'                => __( 'Update Project Category', 'biznews' ),
			'add_new_item'               => __( 'Add New Project Category', 'biznews' ),
			'new_item_name'              => __( 'New Project Category Name', 'biznews' ),
			'parent_item'                => __( 'Parent Project Category', 'biznews' ),
			'parent_item_colon'          => __( 'Parent Project Category:', 'biznews' ),
			'all_items'                  => __( 'All Project TCategory', 'biznews' ),
			'search_items'               => __( 'Search Project TCategory', 'biznews' ),
			'popular_items'              => __( 'Popular Project Category', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Project Category with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Project Category', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Project TCategory', 'biznews' ),
			'not_found'                  => __( 'No Project Category found.', 'biznews' ),
		);
		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'project-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'biznews_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}

}
