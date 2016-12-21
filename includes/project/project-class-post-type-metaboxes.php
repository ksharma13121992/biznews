<?php
/**
 * BiznewsBiznews
 *
 * @package   Biznews
 * @license   GPL-2.0+
 */

/**
 * Register metaboxes.
 *
 * @package Biznews
 */
class Project_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'project_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
	}
	/**
	 * Register the metaboxes to be used for the project post type
	 *
	 * @since 1.0.0
	 */
	public function project_meta_boxes() {
		add_meta_box(
			'project_overview',
			'Project Overview',
			array( $this, 'project_overview_meta_boxes' ),
			'Project',
			'normal',
			'high'
		);
		add_meta_box(
			'project_details',
			'Project Details',
			array( $this, 'project_detail_meta_boxes' ),
			'Project',
			'normal',
			'high'
		);
	}
   /**
	* The HTML for the fields
	*
	* @since 1.0.0
	*/
	function project_overview_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$companies_fund_raised = ! isset( $meta['companies_fund_raised'][0] ) ? '' : $meta['companies_fund_raised'][0];
		$companies_excerpt = ! isset( $meta['companies_excerpt'][0] ) ? '' : $meta['companies_excerpt'][0];
		$companies_website = ! isset( $meta['companies_website'][0] ) ? '' : $meta['companies_website'][0];
		$companies_facebook = ! isset( $meta['companies_facebook'][0] ) ? '' : $meta['companies_facebook'][0];
		$companies_linkedin = ! isset( $meta['companies_linkedin'][0] ) ? '' : $meta['companies_linkedin'][0];
		$companies_twitter = ! isset( $meta['companies_twitter'][0] ) ? '' : $meta['companies_twitter'][0];

		wp_nonce_field( basename( __FILE__ ), 'companies_overview' ); ?>

		<table class="form-table">

			<tr>
				<td class="investment_meta_box_td" colspan="2">
					<label for="companies_fund_raised"><?php _e( 'Funds Raised', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="companies_fund_raised" class="regular-text" value="<?php echo $companies_fund_raised; ?>">
				</td>
			</tr>
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_excerpt"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="companies_excerpt" class="regular-text" value="<?php echo $companies_excerpt; ?>">
				</td>
			</tr>
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_website"><?php _e( 'Website', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="companies_website" class="regular-text" value="<?php echo $companies_website; ?>">
				</td>
			</tr>
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_facebook"><?php _e( 'Facebook', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="companies_facebook" class="regular-text" value="<?php echo $companies_facebook; ?>">
				</td>
			</tr>
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_linkedin"><?php _e( 'LinkedIn', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="companies_linkedin" class="regular-text" value="<?php echo $companies_linkedin; ?>">
				</td>
			</tr>
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_twitter"><?php _e( 'Twitter', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="companies_twitter" class="regular-text" value="<?php echo $companies_twitter; ?>">
				</td>
			</tr>
		</table>
		<?php 
	}
	function project_detail_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$companies_founded = ! isset( $meta['companies_founded'][0] ) ? '' : $meta['companies_founded'][0];
		$companies_contact = ! isset( $meta['companies_contact'][0] ) ? '' : $meta['companies_contact'][0];
		$companies_employees = ! isset( $meta['companies_employees'][0] ) ? '' : $meta['companies_employees'][0];
		$companies_description = ! isset( $meta['companies_description'][0] ) ? '' : $meta['companies_description'][0];
		// wp_nonce_field( plugin_basename( __FILE__ ), 'companies_details' ); ?>
		<table class="form-table">
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_founded"><?php _e( 'Founded', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="companies_founded" class="regular-text" value="<?php echo $companies_founded; ?>">
				</td>
			</tr>
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_contact"><?php _e( 'Contact', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="companies_contact" class="regular-text" value="<?php echo $companies_contact; ?>">
				</td>
			</tr>
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_employees"><?php _e( 'Employees', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="companies_employees" class="regular-text" value="<?php echo $companies_employees; ?>">
					<p class="description"><?php _e( 'Number of Employees' ); ?></p>
				</td>
			</tr>
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_description"><?php _e( 'Description', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="companies_description" class="regular-text" value="<?php echo $companies_description; ?>">
				</td>
			</tr>
		</table>

		<?php 
	}
   	/**
	* Save metaboxes
	*
	* @since 1.0.0
	*/
	function save_meta_boxes( $post_id ) {
		global $post;

		// Verify nonce
		if ( !isset( $_POST['companies_overview'] ) || !wp_verify_nonce( $_POST['companies_overview'], basename(__FILE__) ) ) {
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

		$meta['companies_fund_raised'] = ( isset( $_POST['companies_fund_raised'] ) ? esc_textarea($_POST['companies_fund_raised']) : '' );
		$meta['companies_excerpt'] = ( isset( $_POST['companies_excerpt'] ) ? esc_textarea($_POST['companies_excerpt']) : '' );
		$meta['companies_website'] = ( isset( $_POST['companies_website'] ) ? esc_textarea($_POST['companies_website']) : '' );
		$meta['companies_facebook'] = ( isset( $_POST['companies_facebook'] ) ? esc_url($_POST['companies_facebook'] ): '' );
		$meta['companies_linkedin'] = ( isset( $_POST['companies_linkedin'] ) ? esc_url($_POST['companies_linkedin'] ): '' );
		$meta['companies_twitter'] = ( isset( $_POST['companies_twitter'] ) ? esc_url($_POST['companies_twitter'] ): '' );
		$meta['companies_founded'] = ( isset( $_POST['companies_founded'] ) ? esc_textarea($_POST['companies_founded']) : '' );
		$meta['companies_contact'] = ( isset( $_POST['companies_contact'] ) ? esc_textarea($_POST['companies_contact'] ): '' );
		$meta['companies_employees'] = ( isset( $_POST['companies_employees'] ) ? esc_textarea($_POST['companies_employees'] ): '' );
		$meta['companies_description'] = ( isset( $_POST['companies_description'] ) ? esc_textarea($_POST['companies_description'] ): '' );

		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}

}
