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
class Acquisition_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'acquisition_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
		add_action( 'save_post', array($this , 'save_meta_gallery'), 10 , 2 );
	}

	/**
	 * Register the metaboxes to be used for the investment post type
	 *
	 * @since 0.1.0
	 */
	public function acquisition_meta_boxes() {
		add_meta_box(
			'acquisition_overview',
			'Acquisition Overview',
			array( $this, 'acquisition_overview_meta_boxes' ),
			'Acquisition',
			'normal',
			'high'
		);
		add_meta_box(
			'acquisition_details',
			'Acquisition Details',
			array( $this, 'acquisition_detail_meta_boxes' ),
			'Acquisition',
			'normal',
			'high'
		);
		add_meta_box( 
	        'acquisition_project_taxonomy', 
	        'Acquisition Project',
	        array( $this, 'acquisition_project_taxonomy' ),// $callback
	        'Acquisition', 
	        'normal', 
	        'high' 
	    );
		add_meta_box( 
	        'acquisition_gallery', 
	        'Gallery',
	        array( $this, 'acquisition_gallery' ),// $callback
	        'Acquisition', 
	        'normal', 
	        'high', 
	        array( 'id' => 'acquisition_gallery') 
	    );
	    

	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function acquisition_overview_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		// print_r($meta);
		$acquisition_fund_raised = ! isset( $meta['acquisition_fund_raised'][0] ) ? '' : $meta['acquisition_fund_raised'][0];
		$acquisition_excerpt = ! isset( $meta['acquisition_excerpt'][0] ) ? '' : $meta['acquisition_excerpt'][0];
		$acquisition_website = ! isset( $meta['acquisition_website'][0] ) ? '' : $meta['acquisition_website'][0];
		$acquisition_website_url = ! isset( $meta['acquisition_website_url'][0] ) ? '' : $meta['acquisition_website_url'][0];
		$acquisition_facebook = ! isset( $meta['acquisition_facebook'][0] ) ? '' : $meta['acquisition_facebook'][0];
		$acquisition_linkedin = ! isset( $meta['acquisition_linkedin'][0] ) ? '' : $meta['acquisition_linkedin'][0];
		$acquisition_twitter = ! isset( $meta['acquisition_twitter'][0] ) ? '' : $meta['acquisition_twitter'][0];

		wp_nonce_field( basename( __FILE__ ), 'acquisition_overview' ); ?>

		<table class="form-table">

			<tr>
				<td class="investment_meta_box_td" colspan="2">
					<label for="acquisition_fund_raised"><?php _e( 'Funds Raised', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="acquisition_fund_raised" class="regular-text" value="<?php echo $acquisition_fund_raised; ?>">
				</td>
			</tr>
			<tr>
				<td class="acquisition_meta_box_td" colspan="2">
					<label for="acquisition_excerpt"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<!-- <input type="text" name="acquisition_excerpt" class="regular-text" value="<?php echo $acquisition_excerpt; ?>"> -->
					<textarea name="acquisition_excerpt" class="regular-text" cols="100" rows="4"><?php echo $acquisition_excerpt; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="acquisition_meta_box_td" colspan="2">
					<label for="acquisition_website"><?php _e( 'Website', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="acquisition_website" class="regular-text" value="<?php echo $acquisition_website; ?>">
				</td>
			</tr>
			<tr>
				<td class="acquisition_meta_box_td" colspan="2">
					<label for="acquisition_website_url"><?php _e( 'Website Url', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="acquisition_website_url" class="regular-text" value="<?php echo $acquisition_website_url; ?>">
				</td>
			</tr>
			<tr>
				<td class="acquisition_meta_box_td" colspan="2">
					<label for="acquisition_facebook"><?php _e( 'Facebook', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="acquisition_facebook" class="regular-text" value="<?php echo $acquisition_facebook; ?>">
				</td>
			</tr>
			<tr>
				<td class="acquisition_meta_box_td" colspan="2">
					<label for="acquisition_linkedin"><?php _e( 'LinkedIn', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="acquisition_linkedin" class="regular-text" value="<?php echo $acquisition_linkedin; ?>">
				</td>
			</tr>
			<tr>
				<td class="acquisition_meta_box_td" colspan="2">
					<label for="acquisition_twitter"><?php _e( 'Twitter', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="acquisition_twitter" class="regular-text" value="<?php echo $acquisition_twitter; ?>">
				</td>
			</tr>

		</table>

		<?php 
	}
	function acquisition_detail_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$acquisition_founded = ! isset( $meta['acquisition_founded'][0] ) ? '' : $meta['acquisition_founded'][0];
		$acquisition_contact = ! isset( $meta['acquisition_contact'][0] ) ? '' : $meta['acquisition_contact'][0];
		$acquisition_employees = ! isset( $meta['acquisition_employees'][0] ) ? '' : $meta['acquisition_employees'][0];
		// $acquisition_description = ! isset( $meta['acquisition_description'][0] ) ? '' : $meta['acquisition_description'][0];
		// wp_nonce_field( plugin_basename( __FILE__ ), 'acquisition_details' ); ?>
		<table class="form-table">
			<tr>
				<td class="acquisition_meta_box_td" colspan="2">
					<label for="acquisition_founded"><?php _e( 'Founded', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="acquisition_founded" class="regular-text" value="<?php echo $acquisition_founded; ?>">
				</td>
			</tr>
			<tr>
				<td class="acquisition_meta_box_td" colspan="2">
					<label for="acquisition_contact"><?php _e( 'Contact', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="acquisition_contact" class="regular-text" value="<?php echo $acquisition_contact; ?>">
				</td>
			</tr>
			<tr>
				<td class="acquisition_meta_box_td" colspan="2">
					<label for="acquisition_employees"><?php _e( 'Employees', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="acquisition_employees" class="regular-text" value="<?php echo $acquisition_employees; ?>">
					<p class="description"><?php _e( 'Number of Employees' ); ?></p>
				</td>
			</tr>
			<!-- <tr>
				<td class="acquisition_meta_box_td" colspan="2">
					<label for="acquisition_description"><?php _e( 'Description', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
				<textarea name="acquisition_description" class="regular-text" cols="100" rows="16"><?php echo $acquisition_description; ?></textarea>
				</td>
			</tr> -->
		</table>

		<?php 
	}
	function acquisition_project_taxonomy( $post , $args ){
		wp_nonce_field( basename( __FILE__ ), 'acquisition_project_taxonomy' ); 
	    $query = new WP_Query( 'post_type=project' );
	    if ( $query->have_posts() ) {
		    while ( $query->have_posts() ) {
		        $query->the_post();
		    	$p_taxonomy_id = get_post_meta($post->ID, 'acquisition_project_taxonomy', true);
		    	// print_r($p_taxonomy_id);
		        $id = get_the_ID();
		        $selected = "";
		       	if($p_taxonomy_id){
			        if(in_array($id, $p_taxonomy_id)){
			            $selected = 'checked';
			        }
		       	}
		        echo '<input name="acquisition_project_taxonomy[]" type="checkbox" id="acquisition_project_taxonomy"' . $selected . ' value="' . $id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function acquisition_gallery($post){
	    echo '<table class="form-table">';
	        // get value of this field if it exists for this post
		    $index = 0;
		    $acquisition_repeatable = 'acquisition_repeatable';
			$meta = get_post_custom( $post->ID );
			while($meta[$acquisition_repeatable.'_'.$index]) {
				$acquisition_repeatable.'_'.$index;
	        	$acquisition_meta[] = get_post_meta( $post->ID,$acquisition_repeatable.'_'.$index, FALSE );
		  		$index++;
			}
			wp_nonce_field( basename( __FILE__ ), 'acquisition_gallery' ); 
			// print_r($acquisition_meta);
	        echo '<tr>
                <th><label for="acquisition_repeatable">Repeatable</label></th>
                <td>';
					    echo '<a class="repeatable-add button" href="#">+</a>
					            <ul id="acquisition_repeatable_ul" class="custom_repeatable">';
				    	$i = 0;
					    if ($acquisition_meta) {
					        foreach($acquisition_meta as $row) {
					        	foreach ($row as $val) {
			                        echo '<li><span class="sort hndle">|||</span>
						                <input name="acquisition_repeatable_'.$i.'" type="text" id="acquisition_repeatable" class="custom_upload_image" value="'.$val.'"/>
						                <button class="custom_upload_image_button button">Choose Image</button>
					                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
					                    <a class="repeatable-remove button" href="#">-</a></li>';
					        	}
					            $i++;
					        }
					    } else {
				         	echo '<li><span class="sort hndle">|||</span>
						                <input name="acquisition_repeatable_'.$i.'" type="text" id="acquisition_repeatable" class="custom_upload_image" value="'.$val.'"/>
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
		if ( !isset( $_POST['acquisition_overview'] ) || !wp_verify_nonce( $_POST['acquisition_overview'], basename(__FILE__) ) ) {
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

		$meta['acquisition_fund_raised'] = ( isset( $_POST['acquisition_fund_raised'] ) ? esc_textarea($_POST['acquisition_fund_raised']) : '' );
		$meta['acquisition_excerpt'] = ( isset( $_POST['acquisition_excerpt'] ) ? esc_textarea($_POST['acquisition_excerpt']) : '' );
		$meta['acquisition_website'] = ( isset( $_POST['acquisition_website'] ) ? esc_textarea($_POST['acquisition_website']) : '' );
		$meta['acquisition_website_url'] = ( isset( $_POST['acquisition_website_url'] ) ? esc_textarea($_POST['acquisition_website_url']) : '' );
		$meta['acquisition_facebook'] = ( isset( $_POST['acquisition_facebook'] ) ? esc_url($_POST['acquisition_facebook'] ): '' );
		$meta['acquisition_linkedin'] = ( isset( $_POST['acquisition_linkedin'] ) ? esc_url($_POST['acquisition_linkedin'] ): '' );
		$meta['acquisition_twitter'] = ( isset( $_POST['acquisition_twitter'] ) ? esc_url($_POST['acquisition_twitter'] ): '' );
		$meta['acquisition_founded'] = ( isset( $_POST['acquisition_founded'] ) ? esc_textarea($_POST['acquisition_founded']) : '' );
		$meta['acquisition_contact'] = ( isset( $_POST['acquisition_contact'] ) ? esc_textarea($_POST['acquisition_contact'] ): '' );
		$meta['acquisition_employees'] = ( isset( $_POST['acquisition_employees'] ) ? esc_textarea($_POST['acquisition_employees'] ): '' );
		// $meta['acquisition_description'] = ( isset( $_POST['acquisition_description'] ) ? esc_textarea($_POST['acquisition_description'] ): '' );
		$meta['acquisition_project_taxonomy'] = ( isset( $_POST['acquisition_project_taxonomy'] ) ? $_POST['acquisition_project_taxonomy'] : '' );

		$acquisition_repeatable = 'acquisition_repeatable';
	    $index = 0;
		while(isset($_POST[$acquisition_repeatable.'_'.$index])) {
			$meta[$acquisition_repeatable.'_'.$index] = ( isset( $_POST[$acquisition_repeatable.'_'.$index] ) ? $_POST[$acquisition_repeatable.'_'.$index] : '' );
	  		$index++;
		}
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}
	function save_meta_gallery( $post_id ) {
		global $post;
		if ( !isset( $_POST['acquisition_gallery'] ) || !wp_verify_nonce( $_POST['acquisition_gallery'], basename(__FILE__) ) ) {
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
		$acquisition_repeatable = 'acquisition_repeatable';
	    $index = 0;
		while(isset($_POST[$acquisition_repeatable.'_'.$index])) {
			// $meta[$acquisition_repeatable.'_'.$index] = ( isset( $_POST[$acquisition_repeatable.'_'.$index] ) ? $_POST[$acquisition_repeatable.'_'.$index] : '' );
			update_post_meta( $post->ID, $acquisition_repeatable.'_'.$index, $_POST[$acquisition_repeatable.'_'.$index] );
			if ( !$_POST[$acquisition_repeatable.'_'.$index] ) delete_post_meta( $post->ID, $acquisition_repeatable.'_'.$index );
	  		$index++;
		}
	}
}
