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
class Award_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'award_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
		add_action( 'save_post', array($this , 'save_meta_gallery'), 10 , 2 );
	}

	/**
	 * Register the metaboxes to be used for the investment post type
	 *
	 * @since 0.1.0
	 */
	public function award_meta_boxes() {
		add_meta_box(
			'award_overview',
			'Award Overview',
			array( $this, 'award_overview_meta_boxes' ),
			'Award',
			'normal',
			'high'
		);
		add_meta_box(
			'award_details',
			'Award Details',
			array( $this, 'award_detail_meta_boxes' ),
			'Award',
			'normal',
			'high'
		);
		add_meta_box( 
	        'award_project_taxonomy', 
	        'Award Project',
	        array( $this, 'award_project_taxonomy' ),// $callback
	        'Award', 
	        'normal', 
	        'high' 
	    );
		add_meta_box( 
	        'award_gallery', 
	        'Gallery',
	        array( $this, 'award_gallery' ),// $callback
	        'Award', 
	        'normal', 
	        'high', 
	        array( 'id' => 'award_gallery') 
	    );
	    

	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function award_overview_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		// print_r($meta);
		$award_fund_raised = ! isset( $meta['award_fund_raised'][0] ) ? '' : $meta['award_fund_raised'][0];
		$award_excerpt = ! isset( $meta['award_excerpt'][0] ) ? '' : $meta['award_excerpt'][0];
		$award_website = ! isset( $meta['award_website'][0] ) ? '' : $meta['award_website'][0];
		$award_website_url = ! isset( $meta['award_website_url'][0] ) ? '' : $meta['award_website_url'][0];
		$award_facebook = ! isset( $meta['award_facebook'][0] ) ? '' : $meta['award_facebook'][0];
		$award_linkedin = ! isset( $meta['award_linkedin'][0] ) ? '' : $meta['award_linkedin'][0];
		$award_twitter = ! isset( $meta['award_twitter'][0] ) ? '' : $meta['award_twitter'][0];

		wp_nonce_field( basename( __FILE__ ), 'award_overview' ); ?>

		<table class="form-table">

			<tr>
				<td class="investment_meta_box_td" colspan="2">
					<label for="award_fund_raised"><?php _e( 'Funds Raised', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="award_fund_raised" class="regular-text" value="<?php echo $award_fund_raised; ?>">
				</td>
			</tr>
			<tr>
				<td class="award_meta_box_td" colspan="2">
					<label for="award_excerpt"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<!-- <input type="text" name="award_excerpt" class="regular-text" value="<?php echo $award_excerpt; ?>"> -->
					<textarea name="award_excerpt" class="regular-text" cols="100" rows="4"><?php echo $award_excerpt; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="award_meta_box_td" colspan="2">
					<label for="award_website"><?php _e( 'Website', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="award_website" class="regular-text" value="<?php echo $award_website; ?>">
				</td>
			</tr>
			<tr>
				<td class="award_meta_box_td" colspan="2">
					<label for="award_website_url"><?php _e( 'Website Url', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="award_website_url" class="regular-text" value="<?php echo $award_website_url; ?>">
				</td>
			</tr>
			<tr>
				<td class="award_meta_box_td" colspan="2">
					<label for="award_facebook"><?php _e( 'Facebook', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="award_facebook" class="regular-text" value="<?php echo $award_facebook; ?>">
				</td>
			</tr>
			<tr>
				<td class="award_meta_box_td" colspan="2">
					<label for="award_linkedin"><?php _e( 'LinkedIn', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="award_linkedin" class="regular-text" value="<?php echo $award_linkedin; ?>">
				</td>
			</tr>
			<tr>
				<td class="award_meta_box_td" colspan="2">
					<label for="award_twitter"><?php _e( 'Twitter', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="award_twitter" class="regular-text" value="<?php echo $award_twitter; ?>">
				</td>
			</tr>

		</table>

		<?php 
	}
	function award_detail_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$award_founded = ! isset( $meta['award_founded'][0] ) ? '' : $meta['award_founded'][0];
		$award_contact = ! isset( $meta['award_contact'][0] ) ? '' : $meta['award_contact'][0];
		$award_employees = ! isset( $meta['award_employees'][0] ) ? '' : $meta['award_employees'][0];
		// $award_description = ! isset( $meta['award_description'][0] ) ? '' : $meta['award_description'][0];
		// wp_nonce_field( plugin_basename( __FILE__ ), 'award_details' ); ?>
		<table class="form-table">
			<tr>
				<td class="award_meta_box_td" colspan="2">
					<label for="award_founded"><?php _e( 'Founded', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="award_founded" class="regular-text" value="<?php echo $award_founded; ?>">
				</td>
			</tr>
			<tr>
				<td class="award_meta_box_td" colspan="2">
					<label for="award_contact"><?php _e( 'Contact', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="award_contact" class="regular-text" value="<?php echo $award_contact; ?>">
				</td>
			</tr>
			<tr>
				<td class="award_meta_box_td" colspan="2">
					<label for="award_employees"><?php _e( 'Employees', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="award_employees" class="regular-text" value="<?php echo $award_employees; ?>">
					<p class="description"><?php _e( 'Number of Employees' ); ?></p>
				</td>
			</tr>
			<!-- <tr>
				<td class="award_meta_box_td" colspan="2">
					<label for="award_description"><?php _e( 'Description', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
				<textarea name="award_description" class="regular-text" cols="100" rows="16"><?php echo $award_description; ?></textarea>
				</td>
			</tr> -->
		</table>

		<?php 
	}
	function award_project_taxonomy( $post , $args ){
		wp_nonce_field( basename( __FILE__ ), 'award_project_taxonomy' ); 
	    $query = new WP_Query( 'post_type=project' );
	    if ( $query->have_posts() ) {
		    while ( $query->have_posts() ) {
		        $query->the_post();
		    	$p_taxonomy_id = get_post_meta($post->ID, 'award_project_taxonomy', true);
		    	// print_r($p_taxonomy_id);
		        $id = get_the_ID();
		        $selected = "";
		       	if($p_taxonomy_id){
			        if(in_array($id, $p_taxonomy_id)){
			            $selected = 'checked';
			        }
		       	}
		        echo '<input name="award_project_taxonomy[]" type="checkbox" id="award_project_taxonomy"' . $selected . ' value="' . $id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function award_gallery($post){
	    echo '<table class="form-table">';
	        // get value of this field if it exists for this post
		    $index = 0;
		    $award_repeatable = 'award_repeatable';
			$meta = get_post_custom( $post->ID );
			while($meta[$award_repeatable.'_'.$index]) {
				$award_repeatable.'_'.$index;
	        	$award_meta[] = get_post_meta( $post->ID,$award_repeatable.'_'.$index, FALSE );
		  		$index++;
			}
			wp_nonce_field( basename( __FILE__ ), 'award_gallery' ); 
			// print_r($award_meta);
	        echo '<tr>
                <th><label for="award_repeatable">Repeatable</label></th>
                <td>';
					    echo '<a class="repeatable-add button" href="#">+</a>
					            <ul id="award_repeatable_ul" class="custom_repeatable">';
				    	$i = 0;
					    if ($award_meta) {
					        foreach($award_meta as $row) {
					        	foreach ($row as $val) {
			                        echo '<li><span class="sort hndle">|||</span>
						                <input name="award_repeatable_'.$i.'" type="text" id="award_repeatable" class="custom_upload_image" value="'.$val.'"/>
						                <button class="custom_upload_image_button button">Choose Image</button>
					                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
					                    <a class="repeatable-remove button" href="#">-</a></li>';
					        	}
					            $i++;
					        }
					    } else {
				         	echo '<li><span class="sort hndle">|||</span>
						                <input name="award_repeatable_'.$i.'" type="text" id="award_repeatable" class="custom_upload_image" value="'.$val.'"/>
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
		if ( !isset( $_POST['award_overview'] ) || !wp_verify_nonce( $_POST['award_overview'], basename(__FILE__) ) ) {
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

		$meta['award_fund_raised'] = ( isset( $_POST['award_fund_raised'] ) ? esc_textarea($_POST['award_fund_raised']) : '' );
		$meta['award_excerpt'] = ( isset( $_POST['award_excerpt'] ) ? esc_textarea($_POST['award_excerpt']) : '' );
		$meta['award_website'] = ( isset( $_POST['award_website'] ) ? esc_textarea($_POST['award_website']) : '' );
		$meta['award_website_url'] = ( isset( $_POST['award_website_url'] ) ? esc_textarea($_POST['award_website_url']) : '' );
		$meta['award_facebook'] = ( isset( $_POST['award_facebook'] ) ? esc_url($_POST['award_facebook'] ): '' );
		$meta['award_linkedin'] = ( isset( $_POST['award_linkedin'] ) ? esc_url($_POST['award_linkedin'] ): '' );
		$meta['award_twitter'] = ( isset( $_POST['award_twitter'] ) ? esc_url($_POST['award_twitter'] ): '' );
		$meta['award_founded'] = ( isset( $_POST['award_founded'] ) ? esc_textarea($_POST['award_founded']) : '' );
		$meta['award_contact'] = ( isset( $_POST['award_contact'] ) ? esc_textarea($_POST['award_contact'] ): '' );
		$meta['award_employees'] = ( isset( $_POST['award_employees'] ) ? esc_textarea($_POST['award_employees'] ): '' );
		// $meta['award_description'] = ( isset( $_POST['award_description'] ) ? esc_textarea($_POST['award_description'] ): '' );
		$meta['award_project_taxonomy'] = ( isset( $_POST['award_project_taxonomy'] ) ? $_POST['award_project_taxonomy'] : '' );

		$award_repeatable = 'award_repeatable';
	    $index = 0;
		while(isset($_POST[$award_repeatable.'_'.$index])) {
			$meta[$award_repeatable.'_'.$index] = ( isset( $_POST[$award_repeatable.'_'.$index] ) ? $_POST[$award_repeatable.'_'.$index] : '' );
	  		$index++;
		}
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}
	function save_meta_gallery( $post_id ) {
		global $post;
		if ( !isset( $_POST['award_gallery'] ) || !wp_verify_nonce( $_POST['award_gallery'], basename(__FILE__) ) ) {
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
		$award_repeatable = 'award_repeatable';
	    $index = 0;
		while(isset($_POST[$award_repeatable.'_'.$index])) {
			// $meta[$award_repeatable.'_'.$index] = ( isset( $_POST[$award_repeatable.'_'.$index] ) ? $_POST[$award_repeatable.'_'.$index] : '' );
			update_post_meta( $post->ID, $award_repeatable.'_'.$index, $_POST[$award_repeatable.'_'.$index] );
			if ( !$_POST[$award_repeatable.'_'.$index] ) delete_post_meta( $post->ID, $award_repeatable.'_'.$index );
	  		$index++;
		}
	}
}
