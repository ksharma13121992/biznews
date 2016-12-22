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
		add_action( 'save_post', array($this , 'save_meta_gallery'), 10 , 2 );
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
		add_meta_box(
			'fundinground_details',
			'Fundinground Details',
			array( $this, 'fundinground_detail_meta_boxes' ),
			'Fundinground',
			'normal',
			'high'
		);
		add_meta_box( 
	        'fundinground_project_taxonomy', 
	        'Fundinground Project',
	        array( $this, 'fundinground_project_taxonomy' ),// $callback
	        'Fundinground', 
	        'normal', 
	        'high' 
	    );
		add_meta_box( 
	        'fundinground_gallery', 
	        'Gallery',
	        array( $this, 'fundinground_gallery' ),// $callback
	        'Fundinground', 
	        'normal', 
	        'high', 
	        array( 'id' => 'fundinground_gallery') 
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
		$fundinground_fund_raised = ! isset( $meta['fundinground_fund_raised'][0] ) ? '' : $meta['fundinground_fund_raised'][0];
		$fundinground_excerpt = ! isset( $meta['fundinground_excerpt'][0] ) ? '' : $meta['fundinground_excerpt'][0];
		$fundinground_website = ! isset( $meta['fundinground_website'][0] ) ? '' : $meta['fundinground_website'][0];
		$fundinground_website_url = ! isset( $meta['fundinground_website_url'][0] ) ? '' : $meta['fundinground_website_url'][0];
		$fundinground_facebook = ! isset( $meta['fundinground_facebook'][0] ) ? '' : $meta['fundinground_facebook'][0];
		$fundinground_linkedin = ! isset( $meta['fundinground_linkedin'][0] ) ? '' : $meta['fundinground_linkedin'][0];
		$fundinground_twitter = ! isset( $meta['fundinground_twitter'][0] ) ? '' : $meta['fundinground_twitter'][0];

		wp_nonce_field( basename( __FILE__ ), 'fundinground_overview' ); ?>

		<table class="form-table">

			<tr>
				<td class="investment_meta_box_td" colspan="2">
					<label for="fundinground_fund_raised"><?php _e( 'Funds Raised', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="fundinground_fund_raised" class="regular-text" value="<?php echo $fundinground_fund_raised; ?>">
				</td>
			</tr>
			<tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_excerpt"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<!-- <input type="text" name="fundinground_excerpt" class="regular-text" value="<?php echo $fundinground_excerpt; ?>"> -->
					<textarea name="fundinground_excerpt" class="regular-text" cols="100" rows="4"><?php echo $fundinground_excerpt; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_website"><?php _e( 'Website', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="fundinground_website" class="regular-text" value="<?php echo $fundinground_website; ?>">
				</td>
			</tr>
			<tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_website_url"><?php _e( 'Website Url', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="fundinground_website_url" class="regular-text" value="<?php echo $fundinground_website_url; ?>">
				</td>
			</tr>
			<tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_facebook"><?php _e( 'Facebook', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="fundinground_facebook" class="regular-text" value="<?php echo $fundinground_facebook; ?>">
				</td>
			</tr>
			<tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_linkedin"><?php _e( 'LinkedIn', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="fundinground_linkedin" class="regular-text" value="<?php echo $fundinground_linkedin; ?>">
				</td>
			</tr>
			<tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_twitter"><?php _e( 'Twitter', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="fundinground_twitter" class="regular-text" value="<?php echo $fundinground_twitter; ?>">
				</td>
			</tr>

		</table>

		<?php 
	}
	function fundinground_detail_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$fundinground_founded = ! isset( $meta['fundinground_founded'][0] ) ? '' : $meta['fundinground_founded'][0];
		$fundinground_contact = ! isset( $meta['fundinground_contact'][0] ) ? '' : $meta['fundinground_contact'][0];
		$fundinground_employees = ! isset( $meta['fundinground_employees'][0] ) ? '' : $meta['fundinground_employees'][0];
		// $fundinground_description = ! isset( $meta['fundinground_description'][0] ) ? '' : $meta['fundinground_description'][0];
		// wp_nonce_field( plugin_basename( __FILE__ ), 'fundinground_details' ); ?>
		<table class="form-table">
			<tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_founded"><?php _e( 'Founded', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="fundinground_founded" class="regular-text" value="<?php echo $fundinground_founded; ?>">
				</td>
			</tr>
			<tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_contact"><?php _e( 'Contact', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="fundinground_contact" class="regular-text" value="<?php echo $fundinground_contact; ?>">
				</td>
			</tr>
			<tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_employees"><?php _e( 'Employees', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="fundinground_employees" class="regular-text" value="<?php echo $fundinground_employees; ?>">
					<p class="description"><?php _e( 'Number of Employees' ); ?></p>
				</td>
			</tr>
			<!-- <tr>
				<td class="fundinground_meta_box_td" colspan="2">
					<label for="fundinground_description"><?php _e( 'Description', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
				<textarea name="fundinground_description" class="regular-text" cols="100" rows="16"><?php echo $fundinground_description; ?></textarea>
				</td>
			</tr> -->
		</table>

		<?php 
	}
	function fundinground_project_taxonomy( $post , $args ){
		wp_nonce_field( basename( __FILE__ ), 'fundinground_project_taxonomy' ); 
	    $query = new WP_Query( 'post_type=project' );
	    if ( $query->have_posts() ) {
		    while ( $query->have_posts() ) {
		        $query->the_post();
		    	$p_taxonomy_id = get_post_meta($post->ID, 'fundinground_project_taxonomy', true);
		    	// print_r($p_taxonomy_id);
		        $id = get_the_ID();
		        $selected = "";
		       	if($p_taxonomy_id){
			        if(in_array($id, $p_taxonomy_id)){
			            $selected = 'checked';
			        }
		       	}
		        echo '<input name="fundinground_project_taxonomy[]" type="checkbox" id="fundinground_project_taxonomy"' . $selected . ' value="' . $id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function fundinground_gallery($post){
	    echo '<table class="form-table">';
	        // get value of this field if it exists for this post
		    $index = 0;
		    $fundinground_repeatable = 'fundinground_repeatable';
			$meta = get_post_custom( $post->ID );
			while($meta[$fundinground_repeatable.'_'.$index]) {
				$fundinground_repeatable.'_'.$index;
	        	$fundinground_meta[] = get_post_meta( $post->ID,$fundinground_repeatable.'_'.$index, FALSE );
		  		$index++;
			}
			wp_nonce_field( basename( __FILE__ ), 'fundinground_gallery' ); 
			// print_r($fundinground_meta);
	        echo '<tr>
                <th><label for="fundinground_repeatable">Repeatable</label></th>
                <td>';
					    echo '<a class="repeatable-add button" href="#">+</a>
					            <ul id="fundinground_repeatable_ul" class="custom_repeatable">';
				    	$i = 0;
					    if ($fundinground_meta) {
					        foreach($fundinground_meta as $row) {
					        	foreach ($row as $val) {
			                        echo '<li><span class="sort hndle">|||</span>
						                <input name="fundinground_repeatable_'.$i.'" type="text" id="fundinground_repeatable" class="custom_upload_image" value="'.$val.'"/>
						                <button class="custom_upload_image_button button">Choose Image</button>
					                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
					                    <a class="repeatable-remove button" href="#">-</a></li>';
					        	}
					            $i++;
					        }
					    } else {
				         	echo '<li><span class="sort hndle">|||</span>
						                <input name="fundinground_repeatable_'.$i.'" type="text" id="fundinground_repeatable" class="custom_upload_image" value="'.$val.'"/>
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

		$meta['fundinground_fund_raised'] = ( isset( $_POST['fundinground_fund_raised'] ) ? esc_textarea($_POST['fundinground_fund_raised']) : '' );
		$meta['fundinground_excerpt'] = ( isset( $_POST['fundinground_excerpt'] ) ? esc_textarea($_POST['fundinground_excerpt']) : '' );
		$meta['fundinground_website'] = ( isset( $_POST['fundinground_website'] ) ? esc_textarea($_POST['fundinground_website']) : '' );
		$meta['fundinground_website_url'] = ( isset( $_POST['fundinground_website_url'] ) ? esc_textarea($_POST['fundinground_website_url']) : '' );
		$meta['fundinground_facebook'] = ( isset( $_POST['fundinground_facebook'] ) ? esc_url($_POST['fundinground_facebook'] ): '' );
		$meta['fundinground_linkedin'] = ( isset( $_POST['fundinground_linkedin'] ) ? esc_url($_POST['fundinground_linkedin'] ): '' );
		$meta['fundinground_twitter'] = ( isset( $_POST['fundinground_twitter'] ) ? esc_url($_POST['fundinground_twitter'] ): '' );
		$meta['fundinground_founded'] = ( isset( $_POST['fundinground_founded'] ) ? esc_textarea($_POST['fundinground_founded']) : '' );
		$meta['fundinground_contact'] = ( isset( $_POST['fundinground_contact'] ) ? esc_textarea($_POST['fundinground_contact'] ): '' );
		$meta['fundinground_employees'] = ( isset( $_POST['fundinground_employees'] ) ? esc_textarea($_POST['fundinground_employees'] ): '' );
		// $meta['fundinground_description'] = ( isset( $_POST['fundinground_description'] ) ? esc_textarea($_POST['fundinground_description'] ): '' );
		$meta['fundinground_project_taxonomy'] = ( isset( $_POST['fundinground_project_taxonomy'] ) ? $_POST['fundinground_project_taxonomy'] : '' );

		$fundinground_repeatable = 'fundinground_repeatable';
	    $index = 0;
		while(isset($_POST[$fundinground_repeatable.'_'.$index])) {
			$meta[$fundinground_repeatable.'_'.$index] = ( isset( $_POST[$fundinground_repeatable.'_'.$index] ) ? $_POST[$fundinground_repeatable.'_'.$index] : '' );
	  		$index++;
		}
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}
	function save_meta_gallery( $post_id ) {
		global $post;
		if ( !isset( $_POST['fundinground_gallery'] ) || !wp_verify_nonce( $_POST['fundinground_gallery'], basename(__FILE__) ) ) {
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
		$fundinground_repeatable = 'fundinground_repeatable';
	    $index = 0;
		while(isset($_POST[$fundinground_repeatable.'_'.$index])) {
			// $meta[$fundinground_repeatable.'_'.$index] = ( isset( $_POST[$fundinground_repeatable.'_'.$index] ) ? $_POST[$fundinground_repeatable.'_'.$index] : '' );
			update_post_meta( $post->ID, $fundinground_repeatable.'_'.$index, $_POST[$fundinground_repeatable.'_'.$index] );
			if ( !$_POST[$fundinground_repeatable.'_'.$index] ) delete_post_meta( $post->ID, $fundinground_repeatable.'_'.$index );
	  		$index++;
		}
	}
}
