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
class People_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'people_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
		add_action( 'save_post', array($this , 'save_meta_gallery'), 10 , 2 );
	}

	/**
	 * Register the metaboxes to be used for the investment post type
	 *
	 * @since 0.1.0
	 */
	public function people_meta_boxes() {
		add_meta_box(
			'people_overview',
			'People Overview',
			array( $this, 'people_overview_meta_boxes' ),
			'People',
			'normal',
			'high'
		);
		add_meta_box(
			'people_details',
			'People Details',
			array( $this, 'people_detail_meta_boxes' ),
			'People',
			'normal',
			'high'
		);
		add_meta_box( 
	        'people_project_taxonomy', 
	        'People Project',
	        array( $this, 'people_project_taxonomy' ),// $callback
	        'People', 
	        'normal', 
	        'high' 
	    );
		add_meta_box( 
	        'people_gallery', 
	        'Gallery',
	        array( $this, 'people_gallery' ),// $callback
	        'People', 
	        'normal', 
	        'high', 
	        array( 'id' => 'people_gallery') 
	    );
	    

	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function people_overview_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		// print_r($meta);
		$people_fund_raised = ! isset( $meta['people_fund_raised'][0] ) ? '' : $meta['people_fund_raised'][0];
		$people_excerpt = ! isset( $meta['people_excerpt'][0] ) ? '' : $meta['people_excerpt'][0];
		$people_website = ! isset( $meta['people_website'][0] ) ? '' : $meta['people_website'][0];
		$people_website_url = ! isset( $meta['people_website_url'][0] ) ? '' : $meta['people_website_url'][0];
		$people_facebook = ! isset( $meta['people_facebook'][0] ) ? '' : $meta['people_facebook'][0];
		$people_linkedin = ! isset( $meta['people_linkedin'][0] ) ? '' : $meta['people_linkedin'][0];
		$people_twitter = ! isset( $meta['people_twitter'][0] ) ? '' : $meta['people_twitter'][0];

		wp_nonce_field( basename( __FILE__ ), 'people_overview' ); ?>

		<table class="form-table">

			<tr>
				<td class="investment_meta_box_td" colspan="2">
					<label for="people_fund_raised"><?php _e( 'Funds Raised', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="people_fund_raised" class="regular-text" value="<?php echo $people_fund_raised; ?>">
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_excerpt"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<!-- <input type="text" name="people_excerpt" class="regular-text" value="<?php echo $people_excerpt; ?>"> -->
					<textarea name="people_excerpt" class="regular-text" cols="100" rows="4"><?php echo $people_excerpt; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_website"><?php _e( 'Website', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="people_website" class="regular-text" value="<?php echo $people_website; ?>">
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_website_url"><?php _e( 'Website Url', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="people_website_url" class="regular-text" value="<?php echo $people_website_url; ?>">
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_facebook"><?php _e( 'Facebook', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="people_facebook" class="regular-text" value="<?php echo $people_facebook; ?>">
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_linkedin"><?php _e( 'LinkedIn', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="people_linkedin" class="regular-text" value="<?php echo $people_linkedin; ?>">
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_twitter"><?php _e( 'Twitter', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="people_twitter" class="regular-text" value="<?php echo $people_twitter; ?>">
				</td>
			</tr>

		</table>

		<?php 
	}
	function people_detail_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$people_founded = ! isset( $meta['people_founded'][0] ) ? '' : $meta['people_founded'][0];
		$people_contact = ! isset( $meta['people_contact'][0] ) ? '' : $meta['people_contact'][0];
		$people_employees = ! isset( $meta['people_employees'][0] ) ? '' : $meta['people_employees'][0];
		// $people_description = ! isset( $meta['people_description'][0] ) ? '' : $meta['people_description'][0];
		// wp_nonce_field( plugin_basename( __FILE__ ), 'people_details' ); ?>
		<table class="form-table">
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_founded"><?php _e( 'Founded', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="people_founded" class="regular-text" value="<?php echo $people_founded; ?>">
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_contact"><?php _e( 'Contact', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="people_contact" class="regular-text" value="<?php echo $people_contact; ?>">
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_employees"><?php _e( 'Employees', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="people_employees" class="regular-text" value="<?php echo $people_employees; ?>">
					<p class="description"><?php _e( 'Number of Employees' ); ?></p>
				</td>
			</tr>
			<!-- <tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_description"><?php _e( 'Description', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
				<textarea name="people_description" class="regular-text" cols="100" rows="16"><?php echo $people_description; ?></textarea>
				</td>
			</tr> -->
		</table>

		<?php 
	}
	function people_project_taxonomy( $post , $args ){
		wp_nonce_field( basename( __FILE__ ), 'people_project_taxonomy' ); 
	    $query = new WP_Query( 'post_type=project' );
	    if ( $query->have_posts() ) {
		    while ( $query->have_posts() ) {
		        $query->the_post();
		    	$p_taxonomy_id = get_post_meta($post->ID, 'people_project_taxonomy', true);
		    	// print_r($p_taxonomy_id);
		        $id = get_the_ID();
		        $selected = "";
		       	if($p_taxonomy_id){
			        if(in_array($id, $p_taxonomy_id)){
			            $selected = 'checked';
			        }
		       	}
		        echo '<input name="people_project_taxonomy[]" type="checkbox" id="people_project_taxonomy"' . $selected . ' value="' . $id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function people_gallery($post){
	    echo '<table class="form-table">';
	        // get value of this field if it exists for this post
		    $index = 0;
		    $people_repeatable = 'people_repeatable';
			$meta = get_post_custom( $post->ID );
			while($meta[$people_repeatable.'_'.$index]) {
				$people_repeatable.'_'.$index;
	        	$people_meta[] = get_post_meta( $post->ID,$people_repeatable.'_'.$index, FALSE );
		  		$index++;
			}
			wp_nonce_field( basename( __FILE__ ), 'people_gallery' ); 
			// print_r($people_meta);
	        echo '<tr>
                <th><label for="people_repeatable">Repeatable</label></th>
                <td>';
					    echo '<a class="repeatable-add button" href="#">+</a>
					            <ul id="people_repeatable_ul" class="custom_repeatable">';
				    	$i = 0;
					    if ($people_meta) {
					        foreach($people_meta as $row) {
					        	foreach ($row as $val) {
			                        echo '<li><span class="sort hndle">|||</span>
						                <input name="people_repeatable_'.$i.'" type="text" id="people_repeatable" class="custom_upload_image" value="'.$val.'"/>
						                <button class="custom_upload_image_button button">Choose Image</button>
					                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
					                    <a class="repeatable-remove button" href="#">-</a></li>';
					        	}
					            $i++;
					        }
					    } else {
				         	echo '<li><span class="sort hndle">|||</span>
						                <input name="people_repeatable_'.$i.'" type="text" id="people_repeatable" class="custom_upload_image" value="'.$val.'"/>
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
		if ( !isset( $_POST['people_overview'] ) || !wp_verify_nonce( $_POST['people_overview'], basename(__FILE__) ) ) {
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

		$meta['people_fund_raised'] = ( isset( $_POST['people_fund_raised'] ) ? esc_textarea($_POST['people_fund_raised']) : '' );
		$meta['people_excerpt'] = ( isset( $_POST['people_excerpt'] ) ? esc_textarea($_POST['people_excerpt']) : '' );
		$meta['people_website'] = ( isset( $_POST['people_website'] ) ? esc_textarea($_POST['people_website']) : '' );
		$meta['people_website_url'] = ( isset( $_POST['people_website_url'] ) ? esc_textarea($_POST['people_website_url']) : '' );
		$meta['people_facebook'] = ( isset( $_POST['people_facebook'] ) ? esc_url($_POST['people_facebook'] ): '' );
		$meta['people_linkedin'] = ( isset( $_POST['people_linkedin'] ) ? esc_url($_POST['people_linkedin'] ): '' );
		$meta['people_twitter'] = ( isset( $_POST['people_twitter'] ) ? esc_url($_POST['people_twitter'] ): '' );
		$meta['people_founded'] = ( isset( $_POST['people_founded'] ) ? esc_textarea($_POST['people_founded']) : '' );
		$meta['people_contact'] = ( isset( $_POST['people_contact'] ) ? esc_textarea($_POST['people_contact'] ): '' );
		$meta['people_employees'] = ( isset( $_POST['people_employees'] ) ? esc_textarea($_POST['people_employees'] ): '' );
		// $meta['people_description'] = ( isset( $_POST['people_description'] ) ? esc_textarea($_POST['people_description'] ): '' );
		$meta['people_project_taxonomy'] = ( isset( $_POST['people_project_taxonomy'] ) ? $_POST['people_project_taxonomy'] : '' );

		$people_repeatable = 'people_repeatable';
	    $index = 0;
		while(isset($_POST[$people_repeatable.'_'.$index])) {
			$meta[$people_repeatable.'_'.$index] = ( isset( $_POST[$people_repeatable.'_'.$index] ) ? $_POST[$people_repeatable.'_'.$index] : '' );
	  		$index++;
		}
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}
	function save_meta_gallery( $post_id ) {
		global $post;
		if ( !isset( $_POST['people_gallery'] ) || !wp_verify_nonce( $_POST['people_gallery'], basename(__FILE__) ) ) {
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
		$people_repeatable = 'people_repeatable';
	    $index = 0;
		while(isset($_POST[$people_repeatable.'_'.$index])) {
			// $meta[$people_repeatable.'_'.$index] = ( isset( $_POST[$people_repeatable.'_'.$index] ) ? $_POST[$people_repeatable.'_'.$index] : '' );
			update_post_meta( $post->ID, $people_repeatable.'_'.$index, $_POST[$people_repeatable.'_'.$index] );
			if ( !$_POST[$people_repeatable.'_'.$index] ) delete_post_meta( $post->ID, $people_repeatable.'_'.$index );
	  		$index++;
		}
	}
}
