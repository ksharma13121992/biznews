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
class Location_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'location_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
		add_action( 'save_post', array($this , 'save_meta_gallery'), 10 , 2 );
	}

	/**
	 * Register the metaboxes to be used for the investment post type
	 *
	 * @since 0.1.0
	 */
	public function location_meta_boxes() {
		add_meta_box(
			'location_overview',
			'Location Overview',
			array( $this, 'location_overview_meta_boxes' ),
			'Location',
			'normal',
			'high'
		);
		add_meta_box(
			'location_details',
			'Location Details',
			array( $this, 'location_detail_meta_boxes' ),
			'Location',
			'normal',
			'high'
		);
		add_meta_box( 
	        'location_project_taxonomy', 
	        'Location Project',
	        array( $this, 'location_project_taxonomy' ),// $callback
	        'Location', 
	        'normal', 
	        'high' 
	    );
		add_meta_box( 
	        'location_gallery', 
	        'Gallery',
	        array( $this, 'location_gallery' ),// $callback
	        'Location', 
	        'normal', 
	        'high', 
	        array( 'id' => 'location_gallery') 
	    );
	    

	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function location_overview_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		// print_r($meta);
		$location_fund_raised = ! isset( $meta['location_fund_raised'][0] ) ? '' : $meta['location_fund_raised'][0];
		$location_excerpt = ! isset( $meta['location_excerpt'][0] ) ? '' : $meta['location_excerpt'][0];
		$location_website = ! isset( $meta['location_website'][0] ) ? '' : $meta['location_website'][0];
		$location_website_url = ! isset( $meta['location_website_url'][0] ) ? '' : $meta['location_website_url'][0];
		$location_facebook = ! isset( $meta['location_facebook'][0] ) ? '' : $meta['location_facebook'][0];
		$location_linkedin = ! isset( $meta['location_linkedin'][0] ) ? '' : $meta['location_linkedin'][0];
		$location_twitter = ! isset( $meta['location_twitter'][0] ) ? '' : $meta['location_twitter'][0];

		wp_nonce_field( basename( __FILE__ ), 'location_overview' ); ?>

		<table class="form-table">

			<tr>
				<td class="investment_meta_box_td" colspan="2">
					<label for="location_fund_raised"><?php _e( 'Funds Raised', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="location_fund_raised" class="regular-text" value="<?php echo $location_fund_raised; ?>">
				</td>
			</tr>
			<tr>
				<td class="location_meta_box_td" colspan="2">
					<label for="location_excerpt"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<!-- <input type="text" name="location_excerpt" class="regular-text" value="<?php echo $location_excerpt; ?>"> -->
					<textarea name="location_excerpt" class="regular-text" cols="100" rows="4"><?php echo $location_excerpt; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="location_meta_box_td" colspan="2">
					<label for="location_website"><?php _e( 'Website', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="location_website" class="regular-text" value="<?php echo $location_website; ?>">
				</td>
			</tr>
			<tr>
				<td class="location_meta_box_td" colspan="2">
					<label for="location_website_url"><?php _e( 'Website Url', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="location_website_url" class="regular-text" value="<?php echo $location_website_url; ?>">
				</td>
			</tr>
			<tr>
				<td class="location_meta_box_td" colspan="2">
					<label for="location_facebook"><?php _e( 'Facebook', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="location_facebook" class="regular-text" value="<?php echo $location_facebook; ?>">
				</td>
			</tr>
			<tr>
				<td class="location_meta_box_td" colspan="2">
					<label for="location_linkedin"><?php _e( 'LinkedIn', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="location_linkedin" class="regular-text" value="<?php echo $location_linkedin; ?>">
				</td>
			</tr>
			<tr>
				<td class="location_meta_box_td" colspan="2">
					<label for="location_twitter"><?php _e( 'Twitter', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="location_twitter" class="regular-text" value="<?php echo $location_twitter; ?>">
				</td>
			</tr>

		</table>

		<?php 
	}
	function location_detail_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$location_founded = ! isset( $meta['location_founded'][0] ) ? '' : $meta['location_founded'][0];
		$location_contact = ! isset( $meta['location_contact'][0] ) ? '' : $meta['location_contact'][0];
		$location_employees = ! isset( $meta['location_employees'][0] ) ? '' : $meta['location_employees'][0];
		// $location_description = ! isset( $meta['location_description'][0] ) ? '' : $meta['location_description'][0];
		// wp_nonce_field( plugin_basename( __FILE__ ), 'location_details' ); ?>
		<table class="form-table">
			<tr>
				<td class="location_meta_box_td" colspan="2">
					<label for="location_founded"><?php _e( 'Founded', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="location_founded" class="regular-text" value="<?php echo $location_founded; ?>">
				</td>
			</tr>
			<tr>
				<td class="location_meta_box_td" colspan="2">
					<label for="location_contact"><?php _e( 'Contact', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="location_contact" class="regular-text" value="<?php echo $location_contact; ?>">
				</td>
			</tr>
			<tr>
				<td class="location_meta_box_td" colspan="2">
					<label for="location_employees"><?php _e( 'Employees', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="location_employees" class="regular-text" value="<?php echo $location_employees; ?>">
					<p class="description"><?php _e( 'Number of Employees' ); ?></p>
				</td>
			</tr>
			<!-- <tr>
				<td class="location_meta_box_td" colspan="2">
					<label for="location_description"><?php _e( 'Description', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
				<textarea name="location_description" class="regular-text" cols="100" rows="16"><?php echo $location_description; ?></textarea>
				</td>
			</tr> -->
		</table>

		<?php 
	}
	function location_project_taxonomy( $post , $args ){
		wp_nonce_field( basename( __FILE__ ), 'location_project_taxonomy' ); 
	    $query = new WP_Query( 'post_type=project' );
	    if ( $query->have_posts() ) {
		    while ( $query->have_posts() ) {
		        $query->the_post();
		    	$p_taxonomy_id = get_post_meta($post->ID, 'location_project_taxonomy', true);
		    	// print_r($p_taxonomy_id);
		        $id = get_the_ID();
		        $selected = "";
		       	if($p_taxonomy_id){
			        if(in_array($id, $p_taxonomy_id)){
			            $selected = 'checked';
			        }
		       	}
		        echo '<input name="location_project_taxonomy[]" type="checkbox" id="location_project_taxonomy"' . $selected . ' value="' . $id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function location_gallery($post){
	    echo '<table class="form-table">';
	        // get value of this field if it exists for this post
		    $index = 0;
		    $location_repeatable = 'location_repeatable';
			$meta = get_post_custom( $post->ID );
			while($meta[$location_repeatable.'_'.$index]) {
				$location_repeatable.'_'.$index;
	        	$location_meta[] = get_post_meta( $post->ID,$location_repeatable.'_'.$index, FALSE );
		  		$index++;
			}
			wp_nonce_field( basename( __FILE__ ), 'location_gallery' ); 
			// print_r($location_meta);
	        echo '<tr>
                <th><label for="location_repeatable">Repeatable</label></th>
                <td>';
					    echo '<a class="repeatable-add button" href="#">+</a>
					            <ul id="location_repeatable_ul" class="custom_repeatable">';
				    	$i = 0;
					    if ($location_meta) {
					        foreach($location_meta as $row) {
					        	foreach ($row as $val) {
			                        echo '<li><span class="sort hndle">|||</span>
						                <input name="location_repeatable_'.$i.'" type="text" id="location_repeatable" class="custom_upload_image" value="'.$val.'"/>
						                <button class="custom_upload_image_button button">Choose Image</button>
					                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
					                    <a class="repeatable-remove button" href="#">-</a></li>';
					        	}
					            $i++;
					        }
					    } else {
				         	echo '<li><span class="sort hndle">|||</span>
						                <input name="location_repeatable_'.$i.'" type="text" id="location_repeatable" class="custom_upload_image" value="'.$val.'"/>
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
		if ( !isset( $_POST['location_overview'] ) || !wp_verify_nonce( $_POST['location_overview'], basename(__FILE__) ) ) {
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

		$meta['location_fund_raised'] = ( isset( $_POST['location_fund_raised'] ) ? esc_textarea($_POST['location_fund_raised']) : '' );
		$meta['location_excerpt'] = ( isset( $_POST['location_excerpt'] ) ? esc_textarea($_POST['location_excerpt']) : '' );
		$meta['location_website'] = ( isset( $_POST['location_website'] ) ? esc_textarea($_POST['location_website']) : '' );
		$meta['location_website_url'] = ( isset( $_POST['location_website_url'] ) ? esc_textarea($_POST['location_website_url']) : '' );
		$meta['location_facebook'] = ( isset( $_POST['location_facebook'] ) ? esc_url($_POST['location_facebook'] ): '' );
		$meta['location_linkedin'] = ( isset( $_POST['location_linkedin'] ) ? esc_url($_POST['location_linkedin'] ): '' );
		$meta['location_twitter'] = ( isset( $_POST['location_twitter'] ) ? esc_url($_POST['location_twitter'] ): '' );
		$meta['location_founded'] = ( isset( $_POST['location_founded'] ) ? esc_textarea($_POST['location_founded']) : '' );
		$meta['location_contact'] = ( isset( $_POST['location_contact'] ) ? esc_textarea($_POST['location_contact'] ): '' );
		$meta['location_employees'] = ( isset( $_POST['location_employees'] ) ? esc_textarea($_POST['location_employees'] ): '' );
		// $meta['location_description'] = ( isset( $_POST['location_description'] ) ? esc_textarea($_POST['location_description'] ): '' );
		$meta['location_project_taxonomy'] = ( isset( $_POST['location_project_taxonomy'] ) ? $_POST['location_project_taxonomy'] : '' );

		$location_repeatable = 'location_repeatable';
	    $index = 0;
		while(isset($_POST[$location_repeatable.'_'.$index])) {
			$meta[$location_repeatable.'_'.$index] = ( isset( $_POST[$location_repeatable.'_'.$index] ) ? $_POST[$location_repeatable.'_'.$index] : '' );
	  		$index++;
		}
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}
	function save_meta_gallery( $post_id ) {
		global $post;
		if ( !isset( $_POST['location_gallery'] ) || !wp_verify_nonce( $_POST['location_gallery'], basename(__FILE__) ) ) {
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
		$location_repeatable = 'location_repeatable';
	    $index = 0;
		while(isset($_POST[$location_repeatable.'_'.$index])) {
			// $meta[$location_repeatable.'_'.$index] = ( isset( $_POST[$location_repeatable.'_'.$index] ) ? $_POST[$location_repeatable.'_'.$index] : '' );
			update_post_meta( $post->ID, $location_repeatable.'_'.$index, $_POST[$location_repeatable.'_'.$index] );
			if ( !$_POST[$location_repeatable.'_'.$index] ) delete_post_meta( $post->ID, $location_repeatable.'_'.$index );
	  		$index++;
		}
	}
}
