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
class Companies_Post_Type_Registrations {

	public $post_type = 'companies';

	public $taxonomies = array( 'company-category','companies-type','companies-sector' ,'companies-region','investment-size');

	public function init() {
		// Add the companiespost type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Companies_Post_Type_Registrations::register_post_type()
	 * @uses Companies_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_company_category();
		$this->register_taxonomy_category();
		$this->register_sector_category();
		$this->register_region_category();
		$this->register_investment_size();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Companies', 'biznews' ),
			'singular_name'      => __( 'Companies Member', 'biznews' ),
			'add_new'            => __( 'Add Companies', 'biznews' ),
			'add_new_item'       => __( 'Add Companies', 'biznews' ),
			'edit_item'          => __( 'Edit Companies', 'biznews' ),
			'new_item'           => __( 'New companies Member', 'biznews' ),
			'view_item'          => __( 'View Companies', 'biznews' ),
			'search_items'       => __( 'Search companies', 'biznews' ),
			'not_found'          => __( 'No Company found', 'biznews' ),
			'not_found_in_trash' => __( 'No Company in the trash', 'biznews' ),
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
			'rewrite'         => array( 'slug' => 'organization', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-id',
		);

		$args = apply_filters( 'companies_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	protected function register_company_category() {
		$labels = array(
			'name'                       => __( 'Company Category Type', 'biznews' ),
			'singular_name'              => __( 'Company Category Type', 'biznews' ),
			'menu_name'                  => __( 'Company Category Type', 'biznews' ),
			'edit_item'                  => __( 'Edit Company Category Type', 'biznews' ),
			'update_item'                => __( 'Update Company Category Type', 'biznews' ),
			'add_new_item'               => __( 'Add New Company Category Type', 'biznews' ),
			'new_item_name'              => __( 'New Company Category Type Name', 'biznews' ),
			'parent_item'                => __( 'Parent Company Category Type', 'biznews' ),
			'parent_item_colon'          => __( 'Parent Company Category Type:', 'biznews' ),
			'all_items'                  => __( 'All Company Category Types', 'biznews' ),
			'search_items'               => __( 'Search Company Category Types', 'biznews' ),
			'popular_items'              => __( 'Popular Company Category Type', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Company Category Type with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Company Category Type', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Company Category Types', 'biznews' ),
			'not_found'                  => __( 'No Company Category Type found.', 'biznews' ),
		);
		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'company-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'biznews_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
	/**
	 * Register a taxonomy for companies Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Company Type', 'biznews' ),
			'singular_name'              => __( 'Company Type', 'biznews' ),
			'menu_name'                  => __( 'Company Type', 'biznews' ),
			'edit_item'                  => __( 'Edit Company Type', 'biznews' ),
			'update_item'                => __( 'Update Company Type', 'biznews' ),
			'add_new_item'               => __( 'Add New Company Type', 'biznews' ),
			'new_item_name'              => __( 'New Company Type Name', 'biznews' ),
			'parent_item'                => __( 'Parent Company Type', 'biznews' ),
			'parent_item_colon'          => __( 'Parent Company Type:', 'biznews' ),
			'all_items'                  => __( 'All Company Types', 'biznews' ),
			'search_items'               => __( 'Search Company Types', 'biznews' ),
			'popular_items'              => __( 'Popular Company Type', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Company Type with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Company Type', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Company Types', 'biznews' ),
			'not_found'                  => __( 'No Company Type found.', 'biznews' ),
		);
		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'organization-type' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'biznews_category_args', $args );

		register_taxonomy( $this->taxonomies[1], $this->post_type, $args );
	}

	protected function register_sector_category() {
		$label_sector = array(
			'name'                       => __( 'Company Sector', 'biznews' ),
			'singular_name'              => __( 'Company Sector', 'biznews' ),
			'menu_name'                  => __( 'Company Sector', 'biznews' ),
			'edit_item'                  => __( 'Edit Company Sector', 'biznews' ),
			'update_item'                => __( 'Update Company Sector', 'biznews' ),
			'add_new_item'               => __( 'Add New Company Sector', 'biznews' ),
			'new_item_name'              => __( 'New Company Sector Name', 'biznews' ),
			'parent_item'                => __( 'Parent Company Sector', 'biznews' ),
			'parent_item_colon'          => __( 'Parent Company Sector:', 'biznews' ),
			'all_items'                  => __( 'All Company Sector', 'biznews' ),
			'search_items'               => __( 'Search Company Sector', 'biznews' ),
			'popular_items'              => __( 'Popular Company Sector', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Company Sector with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Company Sector', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Company Sector', 'biznews' ),
			'not_found'                  => __( 'No Company Sector found.', 'biznews' ),
		);
		$args_sector = array(
			'labels'            => $label_sector,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'companies-sector' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args_sector = apply_filters( 'biznews_category_args', $args_sector );

		register_taxonomy( $this->taxonomies[2], $this->post_type, $args_sector );
	}

	protected function register_region_category(){
		$label_region = array(
			'name'                       => __( 'Company Region', 'biznews' ),
			'singular_name'              => __( 'Company Region', 'biznews' ),
			'menu_name'                  => __( 'Company Region', 'biznews' ),
			'edit_item'                  => __( 'Edit Company Region', 'biznews' ),
			'update_item'                => __( 'Update Company Region', 'biznews' ),
			'add_new_item'               => __( 'Add New Company Region', 'biznews' ),
			'new_item_name'              => __( 'New Companies Ryon Name', 'biznews' ),
			'parent_item'                => __( 'Parent Company Region', 'biznews' ),
			'parent_item_colon'          => __( 'Parent CompaniyRegion:', 'biznews' ),
			'all_items'                  => __( 'All Company Region', 'biznews' ),
			'search_items'               => __( 'Search Company Region', 'biznews' ),
			'popular_items'              => __( 'Popular Company Region', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Companies Region with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Company Region', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Company Region', 'biznews' ),
			'not_found'                  => __( 'No Company Region found.', 'biznews' ),
		);
		$args_region = array(
			'labels'            => $label_region,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'organization-region' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args_region = apply_filters( 'biznews_category_args', $args_region );

		register_taxonomy( $this->taxonomies[3], $this->post_type, $args_region );
	}

	protected function register_investment_size(){
		$label_size = array(
			'name'                       => __( 'Investment Size', 'biznews' ),
			'singular_name'              => __( 'Investment Size', 'biznews' ),
			'menu_name'                  => __( 'Investment Size', 'biznews' ),
			'edit_item'                  => __( 'Edit Investment Size', 'biznews' ),
			'update_item'                => __( 'Update Investment Size', 'biznews' ),
			'add_new_item'               => __( 'Add New Investment Size', 'biznews' ),
			'new_item_name'              => __( 'New Investment Size Name', 'biznews' ),
			'parent_item'                => __( 'Parent Investment Size', 'biznews' ),
			'parent_item_colon'          => __( 'Parent Investment Size:', 'biznews' ),
			'all_items'                  => __( 'All Investment Size', 'biznews' ),
			'search_items'               => __( 'Search Investment Size', 'biznews' ),
			'popular_items'              => __( 'Popular Investment Size', 'biznews' ),
			'separate_items_with_commas' => __( 'Separate Investment Size with commas', 'biznews' ),
			'add_or_remove_items'        => __( 'Add or remove Investment Size', 'biznews' ),
			'choose_from_most_used'      => __( 'Choose from the most used Investment Size', 'biznews' ),
			'not_found'                  => __( 'No Investment Size found.', 'biznews' ),
		);
		$args_size = array(
			'labels'            => $label_size,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'investment-size' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args_size = apply_filters( 'biznews_category_args', $args_size );

		register_taxonomy( $this->taxonomies[4], $this->post_type, $args_size );
	}
}
