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
class Event_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'event_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
		add_action( 'save_post', array($this , 'save_meta_gallery'), 10 , 2 );
	}

	/**
	 * Register the metaboxes to be used for the investment post type
	 *
	 * @since 0.1.0
	 */
	public function event_meta_boxes() {
		add_meta_box(
			'event_overview',
			'Event Overview',
			array( $this, 'event_overview_meta_boxes' ),
			'Event',
			'normal',
			'high'
		);
		add_meta_box(
			'event_details',
			'Event Details',
			array( $this, 'event_detail_meta_boxes' ),
			'Event',
			'normal',
			'high'
		);
		add_meta_box( 
	        'event_project_taxonomy', 
	        'Event Project',
	        array( $this, 'event_project_taxonomy' ),// $callback
	        'Event', 
	        'normal', 
	        'high' 
	    );
		add_meta_box( 
	        'event_gallery', 
	        'Gallery',
	        array( $this, 'event_gallery' ),// $callback
	        'Event', 
	        'normal', 
	        'high', 
	        array( 'id' => 'event_gallery') 
	    );
	    

	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function event_overview_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		// print_r($meta);
		$event_fund_raised = ! isset( $meta['event_fund_raised'][0] ) ? '' : $meta['event_fund_raised'][0];
		$event_excerpt = ! isset( $meta['event_excerpt'][0] ) ? '' : $meta['event_excerpt'][0];
		$event_website = ! isset( $meta['event_website'][0] ) ? '' : $meta['event_website'][0];
		$event_website_url = ! isset( $meta['event_website_url'][0] ) ? '' : $meta['event_website_url'][0];
		$event_facebook = ! isset( $meta['event_facebook'][0] ) ? '' : $meta['event_facebook'][0];
		$event_linkedin = ! isset( $meta['event_linkedin'][0] ) ? '' : $meta['event_linkedin'][0];
		$event_twitter = ! isset( $meta['event_twitter'][0] ) ? '' : $meta['event_twitter'][0];

		wp_nonce_field( basename( __FILE__ ), 'event_overview' ); ?>

		<table class="form-table">

			<tr>
				<td class="investment_meta_box_td" colspan="2">
					<label for="event_fund_raised"><?php _e( 'Funds Raised', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="event_fund_raised" class="regular-text" value="<?php echo $event_fund_raised; ?>">
				</td>
			</tr>
			<tr>
				<td class="event_meta_box_td" colspan="2">
					<label for="event_excerpt"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<!-- <input type="text" name="event_excerpt" class="regular-text" value="<?php echo $event_excerpt; ?>"> -->
					<textarea name="event_excerpt" class="regular-text" cols="100" rows="4"><?php echo $event_excerpt; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="event_meta_box_td" colspan="2">
					<label for="event_website"><?php _e( 'Website', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="event_website" class="regular-text" value="<?php echo $event_website; ?>">
				</td>
			</tr>
			<tr>
				<td class="event_meta_box_td" colspan="2">
					<label for="event_website_url"><?php _e( 'Website Url', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="event_website_url" class="regular-text" value="<?php echo $event_website_url; ?>">
				</td>
			</tr>
			<tr>
				<td class="event_meta_box_td" colspan="2">
					<label for="event_facebook"><?php _e( 'Facebook', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="event_facebook" class="regular-text" value="<?php echo $event_facebook; ?>">
				</td>
			</tr>
			<tr>
				<td class="event_meta_box_td" colspan="2">
					<label for="event_linkedin"><?php _e( 'LinkedIn', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="event_linkedin" class="regular-text" value="<?php echo $event_linkedin; ?>">
				</td>
			</tr>
			<tr>
				<td class="event_meta_box_td" colspan="2">
					<label for="event_twitter"><?php _e( 'Twitter', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="event_twitter" class="regular-text" value="<?php echo $event_twitter; ?>">
				</td>
			</tr>

		</table>

		<?php 
	}
	function event_detail_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$event_founded = ! isset( $meta['event_founded'][0] ) ? '' : $meta['event_founded'][0];
		$event_contact = ! isset( $meta['event_contact'][0] ) ? '' : $meta['event_contact'][0];
		$event_employees = ! isset( $meta['event_employees'][0] ) ? '' : $meta['event_employees'][0];
		// $event_description = ! isset( $meta['event_description'][0] ) ? '' : $meta['event_description'][0];
		// wp_nonce_field( plugin_basename( __FILE__ ), 'event_details' ); ?>
		<table class="form-table">
			<tr>
				<td class="event_meta_box_td" colspan="2">
					<label for="event_founded"><?php _e( 'Founded', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="event_founded" class="regular-text" value="<?php echo $event_founded; ?>">
				</td>
			</tr>
			<tr>
				<td class="event_meta_box_td" colspan="2">
					<label for="event_contact"><?php _e( 'Contact', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="event_contact" class="regular-text" value="<?php echo $event_contact; ?>">
				</td>
			</tr>
			<tr>
				<td class="event_meta_box_td" colspan="2">
					<label for="event_employees"><?php _e( 'Employees', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="event_employees" class="regular-text" value="<?php echo $event_employees; ?>">
					<p class="description"><?php _e( 'Number of Employees' ); ?></p>
				</td>
			</tr>
			<!-- <tr>
				<td class="event_meta_box_td" colspan="2">
					<label for="event_description"><?php _e( 'Description', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
				<textarea name="event_description" class="regular-text" cols="100" rows="16"><?php echo $event_description; ?></textarea>
				</td>
			</tr> -->
		</table>

		<?php 
	}
	function event_project_taxonomy( $post , $args ){
		wp_nonce_field( basename( __FILE__ ), 'event_project_taxonomy' ); 
	    $query = new WP_Query( 'post_type=project' );
	    if ( $query->have_posts() ) {
		    while ( $query->have_posts() ) {
		        $query->the_post();
		    	$p_taxonomy_id = get_post_meta($post->ID, 'event_project_taxonomy', true);
		    	// print_r($p_taxonomy_id);
		        $id = get_the_ID();
		        $selected = "";
		       	if($p_taxonomy_id){
			        if(in_array($id, $p_taxonomy_id)){
			            $selected = 'checked';
			        }
		       	}
		        echo '<input name="event_project_taxonomy[]" type="checkbox" id="event_project_taxonomy"' . $selected . ' value="' . $id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function event_gallery($post){
	    echo '<table class="form-table">';
	        // get value of this field if it exists for this post
		    $index = 0;
		    $event_repeatable = 'event_repeatable';
			$meta = get_post_custom( $post->ID );
			while($meta[$event_repeatable.'_'.$index]) {
				$event_repeatable.'_'.$index;
	        	$event_meta[] = get_post_meta( $post->ID,$event_repeatable.'_'.$index, FALSE );
		  		$index++;
			}
			wp_nonce_field( basename( __FILE__ ), 'event_gallery' ); 
			// print_r($event_meta);
	        echo '<tr>
                <th><label for="event_repeatable">Repeatable</label></th>
                <td>';
					    echo '<a class="repeatable-add button" href="#">+</a>
					            <ul id="event_repeatable_ul" class="custom_repeatable">';
				    	$i = 0;
					    if ($event_meta) {
					        foreach($event_meta as $row) {
					        	foreach ($row as $val) {
			                        echo '<li><span class="sort hndle">|||</span>
						                <input name="event_repeatable_'.$i.'" type="text" id="event_repeatable" class="custom_upload_image" value="'.$val.'"/>
						                <button class="custom_upload_image_button button">Choose Image</button>
					                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
					                    <a class="repeatable-remove button" href="#">-</a></li>';
					        	}
					            $i++;
					        }
					    } else {
				         	echo '<li><span class="sort hndle">|||</span>
						                <input name="event_repeatable_'.$i.'" type="text" id="event_repeatable" class="custom_upload_image" value="'.$val.'"/>
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
		if ( !isset( $_POST['event_overview'] ) || !wp_verify_nonce( $_POST['event_overview'], basename(__FILE__) ) ) {
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

		$meta['event_fund_raised'] = ( isset( $_POST['event_fund_raised'] ) ? esc_textarea($_POST['event_fund_raised']) : '' );
		$meta['event_excerpt'] = ( isset( $_POST['event_excerpt'] ) ? esc_textarea($_POST['event_excerpt']) : '' );
		$meta['event_website'] = ( isset( $_POST['event_website'] ) ? esc_textarea($_POST['event_website']) : '' );
		$meta['event_website_url'] = ( isset( $_POST['event_website_url'] ) ? esc_textarea($_POST['event_website_url']) : '' );
		$meta['event_facebook'] = ( isset( $_POST['event_facebook'] ) ? esc_url($_POST['event_facebook'] ): '' );
		$meta['event_linkedin'] = ( isset( $_POST['event_linkedin'] ) ? esc_url($_POST['event_linkedin'] ): '' );
		$meta['event_twitter'] = ( isset( $_POST['event_twitter'] ) ? esc_url($_POST['event_twitter'] ): '' );
		$meta['event_founded'] = ( isset( $_POST['event_founded'] ) ? esc_textarea($_POST['event_founded']) : '' );
		$meta['event_contact'] = ( isset( $_POST['event_contact'] ) ? esc_textarea($_POST['event_contact'] ): '' );
		$meta['event_employees'] = ( isset( $_POST['event_employees'] ) ? esc_textarea($_POST['event_employees'] ): '' );
		// $meta['event_description'] = ( isset( $_POST['event_description'] ) ? esc_textarea($_POST['event_description'] ): '' );
		$meta['event_project_taxonomy'] = ( isset( $_POST['event_project_taxonomy'] ) ? $_POST['event_project_taxonomy'] : '' );

		$event_repeatable = 'event_repeatable';
	    $index = 0;
		while(isset($_POST[$event_repeatable.'_'.$index])) {
			$meta[$event_repeatable.'_'.$index] = ( isset( $_POST[$event_repeatable.'_'.$index] ) ? $_POST[$event_repeatable.'_'.$index] : '' );
	  		$index++;
		}
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}
	function save_meta_gallery( $post_id ) {
		global $post;
		if ( !isset( $_POST['event_gallery'] ) || !wp_verify_nonce( $_POST['event_gallery'], basename(__FILE__) ) ) {
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
		$event_repeatable = 'event_repeatable';
	    $index = 0;
		while(isset($_POST[$event_repeatable.'_'.$index])) {
			// $meta[$event_repeatable.'_'.$index] = ( isset( $_POST[$event_repeatable.'_'.$index] ) ? $_POST[$event_repeatable.'_'.$index] : '' );
			update_post_meta( $post->ID, $event_repeatable.'_'.$index, $_POST[$event_repeatable.'_'.$index] );
			if ( !$_POST[$event_repeatable.'_'.$index] ) delete_post_meta( $post->ID, $event_repeatable.'_'.$index );
	  		$index++;
		}
	}
}
