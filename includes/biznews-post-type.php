<?php
/**
 * Biznews
 *
 * @package   Biznews
 * @license   GPL-2.0+
 */

/**
 * Registration of CPT and related taxonomies.
 *
 * @since 1.0.0
 */
class Biznews_Post_Type{
	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since 1.0.0
	 *
	 * @var string VERSION Plugin version.
	 */
	const VERSION = '1.0.0';
	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	const PLUGIN_SLUG = 'biznews';
	protected $registration_handler;
	/**
	 * Initialize the plugin by setting localization and new site activation hooks.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $registration_handler ) {

		$this->registration_handler = $registration_handler;

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}
	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since 1.0.0
	 */
	public function activate() {
		$this->registration_handler->register();
		flush_rewrite_rules();
	}
	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since 1.0.0
	 */
	public function deactivate() {
		flush_rewrite_rules();
	}
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain() {
		$domain = self::PLUGIN_SLUG;
		load_plugin_textdomain( $domain, FALSE, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
	}
	
	public function enqueue_styles() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Biznews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Biznews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/biznews-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Biznews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Biznews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script('biznews', plugin_dir_url( __FILE__ ) . 'js/biznews-admin.js', array( 'jquery' ), $this->version, false );
	}
}