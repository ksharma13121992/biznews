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
class Event_Post_Type_Registrations {

	public $post_type = 'event';

	public $taxonomies = array( 'event-category');

	public function init() {
		// Add the eventpost type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Event_Post_Type_Registrations::register_post_type()
	 * @uses Event_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_event_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Event', 'biznews' ),
			'singular_name'      => __( 'Event', 'biznews' ),
			'add_new'            => __( 'Add Event', 'biznews' ),
			'add_new_item'       => __( 'Add Event', 'biznews' ),
			'edit_item'          => __( 'Edit Event', 'biznews' ),
			'new_item'           => __( 'New Event', 'biznews' ),
			'view_item'          => __( 'View Event', 'biznews' ),
			'search_items'       => __( 'Search Event', 'biznews' ),
			'not_found'          => __( 'No Event found', 'biznews' ),
			'not_found_in_trash' => __( 'No Event in the trash', 'biznews' ),
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
			'rewrite'         => array( 'slug' => 'event', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-id',
		);

		$args = apply_filters( 'event_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	protected function register_event_category() {
		$labels = array(
			'name'                       => __( 'Event Category Type', 'biznews' ),
			'singular_name'              => __( 'Event Category Type', 'biznews' ),
			'menu_name'                  => __( 'Event Category Type', 'biznews' ),
			'edit_item'                  => __( 'Edit Event Category Type', 'biznews' ),
			'update_item'                => __( 'Update Event Category Type', 'biznews' ),
			'add_new_item'               => __( 'Add New Event Category Type', 'biznews' ),
			'new_item_name'              => __( 'New Event Category Type Name', 'biznews' ),
			'parent_item'                => __( 'Parent Event Category Type', 'biznews' ),
			'parent_item_colon'          => __( 'Parent Event Category Type:', 'biznews' ),
			'all_items'                  => __( 'All Event Category Types', 'biznews' ),
			'search_items'               => __( 'Search Event Category Types', 'biznews' ),
			'popular_items'              => __( 'Popular Event Category Type', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Event Category Type with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Event Category Type', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Event Category Types', 'biznews' ),
			'not_found'                  => __( 'No Event Category Type found.', 'biznews' ),
		);
		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'event-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'biznews_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
	
}
