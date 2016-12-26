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
		$primary_role = ! isset( $meta['primary_role'][0] ) ? '' : $meta['primary_role'][0];
		$primary_company = !isset($meta['primary_company'][0]) ? '' : $meta['primary_company'][0];
		$people_born = ! isset( $meta['people_born'][0] ) ? '' : $meta['people_born'][0];
		$people_gender = ! isset( $meta['people_gender'][0] ) ? '' : $meta['people_gender'][0];
		$people_website = ! isset( $meta['people_website'][0] ) ? '' : $meta['people_website'][0];
		$people_website_url = ! isset( $meta['people_website_url'][0] ) ? '' : $meta['people_website_url'][0];
		$people_facebook = ! isset( $meta['people_facebook'][0] ) ? '' : $meta['people_facebook'][0];
		$people_linkedin = ! isset( $meta['people_linkedin'][0] ) ? '' : $meta['people_linkedin'][0];
		$people_twitter = ! isset( $meta['people_twitter'][0] ) ? '' : $meta['people_twitter'][0];
		$people_location = ! isset( $meta['people_location'][0] ) ? '' : $meta['people_location'][0];
		wp_nonce_field( basename( __FILE__ ), 'people_overview' ); ?>

		<table class="form-table">
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="primary_role"><?php _e( 'Primary Role', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="primary_role" class="regular-text" value="<?php echo $primary_role; ?>">
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="primary_company"><?php _e( 'Primary Company', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<?php
					    $co_query = new WP_Query( 'post_type=companies' );
					    if ( $co_query->have_posts() ) {
					       	echo '<select name="primary_company" class="regular-text">';
							    while ( $co_query->have_posts() ) {
							        $co_query->the_post();
								        $id = get_the_ID();
								        $selected = "";
								       	if($primary_company){
									        if($id == $primary_company){
									            $selected = 'selected';
									        }
								       	}
										echo '<option value="'.$id.'" '.$selected.'>'. get_the_title() .'</option>';
							    }
							echo '</select>';		
						}	
					?>
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_born"><?php _e( 'Born', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="people_born" class="regular-text" value="<?php echo $people_born; ?>">
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_gender"><?php _e( 'Born', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<select name="people_gender" class="regular-text">
						<option value="male" <?php if($people_gender == 'male') { echo "selected";} ?> >Male</option>
						<option value="female" <?php if($people_gender == 'female') { echo "selected";} ?> >Female</option>
						<option value="other" <?php if($people_gender == 'other') { echo "selected";} ?> >Other</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_location"><?php _e( 'Location', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<?php
					    $lo_query = new WP_Query( 'post_type=location' );
					    if ( $lo_query->have_posts() ) {
					       	echo '<select name="people_location" class="regular-text">';
							    while ( $lo_query->have_posts() ) {
							        $lo_query->the_post();
								       	$lo_id = get_the_ID();
								        $lo_selected = "";
								       	if($people_location){
									        if($lo_id == $people_location){
									            $lo_selected = 'selected';
									        }
								       	}
										echo '<option value="'.$lo_id.'" '.$lo_selected.'>'. get_the_title() .'</option>';
							    }
							echo '</select>';		
						}	
					?>
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
	function people_detail_meta_boxes( $post,$args ) {
		$meta = get_post_custom( $post->ID );
		$people_aliase = ! isset( $meta['people_aliase'][0] ) ? '' : $meta['people_aliase'][0];
		?>
		<table class="form-table">
			<tr>
				<td class="people_meta_box_td" colspan="2">
					<label for="people_aliase"><?php _e( 'Aliases', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="people_aliase" class="regular-text" value="<?php echo $people_aliase; ?>">
				</td>
			</tr>
		</table>

		<?php 
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

		$meta['primary_role'] = ( isset( $_POST['primary_role'] ) ? esc_textarea($_POST['primary_role']) : '' );
		$meta['people_born'] = ( isset( $_POST['people_born'] ) ? esc_textarea($_POST['people_born']) : '' );
		$meta['people_gender'] = ( isset( $_POST['people_gender'] ) ? esc_textarea($_POST['people_gender']) : '' );
		$meta['people_website'] = ( isset( $_POST['people_website'] ) ? esc_textarea($_POST['people_website']) : '' );
		$meta['people_website_url'] = ( isset( $_POST['people_website_url'] ) ? esc_textarea($_POST['people_website_url']) : '' );
		$meta['people_facebook'] = ( isset( $_POST['people_facebook'] ) ? esc_url($_POST['people_facebook'] ): '' );
		$meta['people_linkedin'] = ( isset( $_POST['people_linkedin'] ) ? esc_url($_POST['people_linkedin'] ): '' );
		$meta['people_twitter'] = ( isset( $_POST['people_twitter'] ) ? esc_url($_POST['people_twitter'] ): '' );
		$meta['people_aliase'] = ( isset( $_POST['people_aliase'] ) ? esc_textarea($_POST['people_aliase']) : '' );
		$meta['primary_company'] = ( isset( $_POST['primary_company'] ) ? $_POST['primary_company'] : '' );
		$meta['people_location'] = ( isset( $_POST['people_location'] ) ? $_POST['people_location'] : '' );

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
