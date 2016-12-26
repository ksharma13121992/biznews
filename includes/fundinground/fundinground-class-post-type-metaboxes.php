<?php
/**
 * Biznews
 *
 * @package   Biznews
 * @license   GPL-2.0+
 */

/**
 * Register metaboxes.
 *
 * @package Biznews
 */
class Fundinground_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'fundinground_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
	}

	/**
	 * Register the metaboxes to be used for the investment post type
	 *
	 * @since 0.1.0
	 */
	public function fundinground_meta_boxes() {
		add_meta_box(
			'fundinground_overview',
			'Fundinground Overview',
			array( $this, 'fundinground_overview_meta_boxes' ),
			'Fundinground',
			'normal',
			'high'
		);    
	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function fundinground_overview_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		// print_r($meta);
		$fundinground_money_raised = ! isset( $meta['fundinground_money_raised'][0] ) ? '' : $meta['fundinground_money_raised'][0];
		$fundinground_announce = ! isset( $meta['fundinground_announce'][0] ) ? '' : $meta['fundinground_announce'][0];
		$fundinground_website = ! isset( $meta['fundinground_website'][0] ) ? '' : $meta['fundinground_website'][0];
		$fundinground_website_url = ! isset( $meta['fundinground_website_url'][0] ) ? '' : $meta['fundinground_website_url'][0];
		$fundinground_facebook = ! isset( $meta['fundinground_facebook'][0] ) ? '' : $meta['fundinground_facebook'][0];
		$fundinground_linkedin = ! isset( $meta['fundinground_linkedin'][0] ) ? '' : $meta['fundinground_linkedin'][0];
		$fundinground_twitter = ! isset( $meta['fundinground_twitter'][0] ) ? '' : $meta['fundinground_twitter'][0];

		wp_nonce_field( basename( __FILE__ ), 'fundinground_overview' ); ?>

		<table class="form-table">

			<tr>
				<td class="investment_meta_box_td" colspan="2">
					<label for="fundinground_money_raised"><?php _e( 'Money Raised', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="fundinground_money_raised" class="regular-text" value="<?php echo $fundinground_money_raised; ?>">
				</td>
			</tr>
			<tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_announce"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="fundinground_announce" class="regular-text" value="<?php echo $fundinground_announce; ?>">
				</td>
			</tr>

		</table>

		<?php 
	}

   /**
	* Save metaboxes
	*
	* @since 0.1.0
	*/
	function save_meta_boxes( $post_id ) {

		global $post;
		// $meta[] = 0;
		// Verify nonce
		if ( !isset( $_POST['fundinground_overview'] ) || !wp_verify_nonce( $_POST['fundinground_overview'], basename(__FILE__) ) ) {
			return $post_id;
		}

		// Check Autosave
		if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) ) {
			return $post_id;
		}

		// Don't save if only a revision
		if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
			return $post_id;
		}

		// Check permissions
		if ( !current_user_can( 'edit_post', $post->ID ) ) {
			return $post_id;
		}

		$meta['fundinground_money_raised'] = ( isset( $_POST['fundinground_money_raised'] ) ? esc_textarea($_POST['fundinground_money_raised']) : '' );
		$meta['fundinground_announce'] = ( isset( $_POST['fundinground_announce'] ) ? esc_textarea($_POST['fundinground_announce']) : '' );
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}
}
