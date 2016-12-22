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
class Contributor_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'contributor_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
		add_action( 'save_post', array($this , 'save_meta_gallery'), 10 , 2 );
	}

	/**
	 * Register the metaboxes to be used for the investment post type
	 *
	 * @since 0.1.0
	 */
	public function contributor_meta_boxes() {
		add_meta_box(
			'contributor_overview',
			'Contributor Overview',
			array( $this, 'contributor_overview_meta_boxes' ),
			'Contributor',
			'normal',
			'high'
		);
		add_meta_box(
			'contributor_details',
			'Contributor Details',
			array( $this, 'contributor_detail_meta_boxes' ),
			'Contributor',
			'normal',
			'high'
		);
		add_meta_box( 
	        'contributor_project_taxonomy', 
	        'Contributor Project',
	        array( $this, 'contributor_project_taxonomy' ),// $callback
	        'Contributor', 
	        'normal', 
	        'high' 
	    );
		add_meta_box( 
	        'contributor_gallery', 
	        'Gallery',
	        array( $this, 'contributor_gallery' ),// $callback
	        'Contributor', 
	        'normal', 
	        'high', 
	        array( 'id' => 'contributor_gallery') 
	    );
	    

	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function contributor_overview_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		// print_r($meta);
		$contributor_fund_raised = ! isset( $meta['contributor_fund_raised'][0] ) ? '' : $meta['contributor_fund_raised'][0];
		$contributor_excerpt = ! isset( $meta['contributor_excerpt'][0] ) ? '' : $meta['contributor_excerpt'][0];
		$contributor_website = ! isset( $meta['contributor_website'][0] ) ? '' : $meta['contributor_website'][0];
		$contributor_website_url = ! isset( $meta['contributor_website_url'][0] ) ? '' : $meta['contributor_website_url'][0];
		$contributor_facebook = ! isset( $meta['contributor_facebook'][0] ) ? '' : $meta['contributor_facebook'][0];
		$contributor_linkedin = ! isset( $meta['contributor_linkedin'][0] ) ? '' : $meta['contributor_linkedin'][0];
		$contributor_twitter = ! isset( $meta['contributor_twitter'][0] ) ? '' : $meta['contributor_twitter'][0];

		wp_nonce_field( basename( __FILE__ ), 'contributor_overview' ); ?>

		<table class="form-table">

			<tr>
				<td class="investment_meta_box_td" colspan="2">
					<label for="contributor_fund_raised"><?php _e( 'Funds Raised', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="contributor_fund_raised" class="regular-text" value="<?php echo $contributor_fund_raised; ?>">
				</td>
			</tr>
			<tr>
				<td class="contributor_meta_box_td" colspan="2">
					<label for="contributor_excerpt"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<!-- <input type="text" name="contributor_excerpt" class="regular-text" value="<?php echo $contributor_excerpt; ?>"> -->
					<textarea name="contributor_excerpt" class="regular-text" cols="100" rows="4"><?php echo $contributor_excerpt; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="contributor_meta_box_td" colspan="2">
					<label for="contributor_website"><?php _e( 'Website', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="contributor_website" class="regular-text" value="<?php echo $contributor_website; ?>">
				</td>
			</tr>
			<tr>
				<td class="contributor_meta_box_td" colspan="2">
					<label for="contributor_website_url"><?php _e( 'Website Url', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="contributor_website_url" class="regular-text" value="<?php echo $contributor_website_url; ?>">
				</td>
			</tr>
			<tr>
				<td class="contributor_meta_box_td" colspan="2">
					<label for="contributor_facebook"><?php _e( 'Facebook', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="contributor_facebook" class="regular-text" value="<?php echo $contributor_facebook; ?>">
				</td>
			</tr>
			<tr>
				<td class="contributor_meta_box_td" colspan="2">
					<label for="contributor_linkedin"><?php _e( 'LinkedIn', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="contributor_linkedin" class="regular-text" value="<?php echo $contributor_linkedin; ?>">
				</td>
			</tr>
			<tr>
				<td class="contributor_meta_box_td" colspan="2">
					<label for="contributor_twitter"><?php _e( 'Twitter', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="contributor_twitter" class="regular-text" value="<?php echo $contributor_twitter; ?>">
				</td>
			</tr>

		</table>

		<?php 
	}
	function contributor_detail_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$contributor_founded = ! isset( $meta['contributor_founded'][0] ) ? '' : $meta['contributor_founded'][0];
		$contributor_contact = ! isset( $meta['contributor_contact'][0] ) ? '' : $meta['contributor_contact'][0];
		$contributor_employees = ! isset( $meta['contributor_employees'][0] ) ? '' : $meta['contributor_employees'][0];
		// $contributor_description = ! isset( $meta['contributor_description'][0] ) ? '' : $meta['contributor_description'][0];
		// wp_nonce_field( plugin_basename( __FILE__ ), 'contributor_details' ); ?>
		<table class="form-table">
			<tr>
				<td class="contributor_meta_box_td" colspan="2">
					<label for="contributor_founded"><?php _e( 'Founded', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="contributor_founded" class="regular-text" value="<?php echo $contributor_founded; ?>">
				</td>
			</tr>
			<tr>
				<td class="contributor_meta_box_td" colspan="2">
					<label for="contributor_contact"><?php _e( 'Contact', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="contributor_contact" class="regular-text" value="<?php echo $contributor_contact; ?>">
				</td>
			</tr>
			<tr>
				<td class="contributor_meta_box_td" colspan="2">
					<label for="contributor_employees"><?php _e( 'Employees', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="contributor_employees" class="regular-text" value="<?php echo $contributor_employees; ?>">
					<p class="description"><?php _e( 'Number of Employees' ); ?></p>
				</td>
			</tr>
			<!-- <tr>
				<td class="contributor_meta_box_td" colspan="2">
					<label for="contributor_description"><?php _e( 'Description', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
				<textarea name="contributor_description" class="regular-text" cols="100" rows="16"><?php echo $contributor_description; ?></textarea>
				</td>
			</tr> -->
		</table>

		<?php 
	}
	function contributor_project_taxonomy( $post , $args ){
		wp_nonce_field( basename( __FILE__ ), 'contributor_project_taxonomy' ); 
	    $query = new WP_Query( 'post_type=project' );
	    if ( $query->have_posts() ) {
		    while ( $query->have_posts() ) {
		        $query->the_post();
		    	$p_taxonomy_id = get_post_meta($post->ID, 'contributor_project_taxonomy', true);
		    	// print_r($p_taxonomy_id);
		        $id = get_the_ID();
		        $selected = "";
		       	if($p_taxonomy_id){
			        if(in_array($id, $p_taxonomy_id)){
			            $selected = 'checked';
			        }
		       	}
		        echo '<input name="contributor_project_taxonomy[]" type="checkbox" id="contributor_project_taxonomy"' . $selected . ' value="' . $id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function contributor_gallery($post){
	    echo '<table class="form-table">';
	        // get value of this field if it exists for this post
		    $index = 0;
		    $contributor_repeatable = 'contributor_repeatable';
			$meta = get_post_custom( $post->ID );
			while($meta[$contributor_repeatable.'_'.$index]) {
				$contributor_repeatable.'_'.$index;
	        	$contributor_meta[] = get_post_meta( $post->ID,$contributor_repeatable.'_'.$index, FALSE );
		  		$index++;
			}
			wp_nonce_field( basename( __FILE__ ), 'contributor_gallery' ); 
			// print_r($contributor_meta);
	        echo '<tr>
                <th><label for="contributor_repeatable">Repeatable</label></th>
                <td>';
					    echo '<a class="repeatable-add button" href="#">+</a>
					            <ul id="contributor_repeatable_ul" class="custom_repeatable">';
				    	$i = 0;
					    if ($contributor_meta) {
					        foreach($contributor_meta as $row) {
					        	foreach ($row as $val) {
			                        echo '<li><span class="sort hndle">|||</span>
						                <input name="contributor_repeatable_'.$i.'" type="text" id="contributor_repeatable" class="custom_upload_image" value="'.$val.'"/>
						                <button class="custom_upload_image_button button">Choose Image</button>
					                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
					                    <a class="repeatable-remove button" href="#">-</a></li>';
					        	}
					            $i++;
					        }
					    } else {
				         	echo '<li><span class="sort hndle">|||</span>
						                <input name="contributor_repeatable_'.$i.'" type="text" id="contributor_repeatable" class="custom_upload_image" value="'.$val.'"/>
					                    <button class="custom_upload_image_button button">Choose Image</button>
					                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
					                    <a class="repeatable-remove button" href="#">-</a></li>';
					    }
					    echo '</ul>
				        <span class="description">A description for the field.</span>';
	        	echo '</td>	
	        </tr>';
	    echo '</table>'; // end table
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
		if ( !isset( $_POST['contributor_overview'] ) || !wp_verify_nonce( $_POST['contributor_overview'], basename(__FILE__) ) ) {
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

		$meta['contributor_fund_raised'] = ( isset( $_POST['contributor_fund_raised'] ) ? esc_textarea($_POST['contributor_fund_raised']) : '' );
		$meta['contributor_excerpt'] = ( isset( $_POST['contributor_excerpt'] ) ? esc_textarea($_POST['contributor_excerpt']) : '' );
		$meta['contributor_website'] = ( isset( $_POST['contributor_website'] ) ? esc_textarea($_POST['contributor_website']) : '' );
		$meta['contributor_website_url'] = ( isset( $_POST['contributor_website_url'] ) ? esc_textarea($_POST['contributor_website_url']) : '' );
		$meta['contributor_facebook'] = ( isset( $_POST['contributor_facebook'] ) ? esc_url($_POST['contributor_facebook'] ): '' );
		$meta['contributor_linkedin'] = ( isset( $_POST['contributor_linkedin'] ) ? esc_url($_POST['contributor_linkedin'] ): '' );
		$meta['contributor_twitter'] = ( isset( $_POST['contributor_twitter'] ) ? esc_url($_POST['contributor_twitter'] ): '' );
		$meta['contributor_founded'] = ( isset( $_POST['contributor_founded'] ) ? esc_textarea($_POST['contributor_founded']) : '' );
		$meta['contributor_contact'] = ( isset( $_POST['contributor_contact'] ) ? esc_textarea($_POST['contributor_contact'] ): '' );
		$meta['contributor_employees'] = ( isset( $_POST['contributor_employees'] ) ? esc_textarea($_POST['contributor_employees'] ): '' );
		// $meta['contributor_description'] = ( isset( $_POST['contributor_description'] ) ? esc_textarea($_POST['contributor_description'] ): '' );
		$meta['contributor_project_taxonomy'] = ( isset( $_POST['contributor_project_taxonomy'] ) ? $_POST['contributor_project_taxonomy'] : '' );

		$contributor_repeatable = 'contributor_repeatable';
	    $index = 0;
		while(isset($_POST[$contributor_repeatable.'_'.$index])) {
			$meta[$contributor_repeatable.'_'.$index] = ( isset( $_POST[$contributor_repeatable.'_'.$index] ) ? $_POST[$contributor_repeatable.'_'.$index] : '' );
	  		$index++;
		}
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}
	function save_meta_gallery( $post_id ) {
		global $post;
		if ( !isset( $_POST['contributor_gallery'] ) || !wp_verify_nonce( $_POST['contributor_gallery'], basename(__FILE__) ) ) {
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
		$contributor_repeatable = 'contributor_repeatable';
	    $index = 0;
		while(isset($_POST[$contributor_repeatable.'_'.$index])) {
			// $meta[$contributor_repeatable.'_'.$index] = ( isset( $_POST[$contributor_repeatable.'_'.$index] ) ? $_POST[$contributor_repeatable.'_'.$index] : '' );
			update_post_meta( $post->ID, $contributor_repeatable.'_'.$index, $_POST[$contributor_repeatable.'_'.$index] );
			if ( !$_POST[$contributor_repeatable.'_'.$index] ) delete_post_meta( $post->ID, $contributor_repeatable.'_'.$index );
	  		$index++;
		}
	}
}
