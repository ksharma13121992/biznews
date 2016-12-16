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
class Project_Post_Type_Metaboxes {
	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'project_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
		add_action('save_post', array( $this,'save_custom_meta' ),  10, 2 );
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
		add_meta_box(
	        'project_gallery', // $id
	        'Gallery', // $title 
	        array( $this, 'project_gallery_meta_boxes' ),// $callback
	        'Project', // $page
	        'normal', // $context
	        'high'
        ); // $priority
	}
   /**
	* The HTML for the fields
	*
	* @since 1.0.0
	*/
	// function project_gallery_meta_boxes() {
	// 	global $custom_meta_fields, $post;
	// 	$prefix = 'custom_';
	// 	$custom_meta_fields = array(
	// 	    array(
	// 		    'label' => 'Repeatable',
	// 		    'desc'  => 'A description for the field.',
	// 		    'id'    => $prefix.'repeatable',
	// 		    'type'  => 'repeatable'
	// 		)
	// 	);
	// 	// Use nonce for verification
	// 	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />'; 
	//     // Begin the field table and loop
	//     echo '<table class="form-table">';
	//     foreach ($custom_meta_fields as $field) {
	//         // get value of this field if it exists for this post
	//         $meta = get_post_meta($post->ID, $field['id'], true);
	//         // begin a table row with
	//         echo '<tr>
	//                 <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
	//                 <td>';
	//                 switch($field['type']) {
	//                    // text
	// 					case 'repeatable':
	// 					    echo '<a class="repeatable-add button" href="#">+</a>
	// 					            <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
	// 					    $i = 0;
	// 					    if ($meta) {
	// 					        foreach($meta as $row) {
	// 					            echo '<li><span class="sort hndle">|||</span>
	// 					                <input name="'.$field['id'].'['.$i.']" type="hidden" class="custom_upload_image" value="'.$image.'"/>
	// 					                <button class="custom_upload_image_button button">Choose Image</button>
	// 				                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
	// 				                    <a class="repeatable-remove button" href="#">-</a></li>';
	// 					            $i++;
	// 					        }
	// 					    } else {
	// 					        echo '<li><span class="sort hndle">|||</span>
	// 					                <input name="'.$field['id'].'['.$i.']" type="text" class="custom_upload_image" value="'.$image.'"/>
	// 				                    <button class="custom_upload_image_button button">Choose Image</button>
	// 				                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
	// 				                    <a class="repeatable-remove button" href="#">-</a></li>';
	// 					    }
	// 					    echo '</ul>
	// 				        <span class="description">'.$field['desc'].'</span>';
	// 					break;
	//                 } //end switch
	//         echo '</td></tr>';
	//     } // end foreach
	//     echo '</table>'; // end table
	// }
	function project_overview_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$project_owner = ! isset( $meta['project_owner'][0] ) ? '' : $meta['project_owner'][0];
		$project_status = ! isset( $meta['project_status'][0] ) ? '' : $meta['project_status'][0];
		$project_excerpt = ! isset( $meta['project_excerpt'][0] ) ? '' : $meta['project_excerpt'][0];
		$project_website = ! isset( $meta['project_website'][0] ) ? '' : $meta['project_website'][0];
		$project_facebook = ! isset( $meta['project_facebook'][0] ) ? '' : $meta['project_facebook'][0];
		$project_linkedin = ! isset( $meta['project_linkedin'][0] ) ? '' : $meta['project_linkedin'][0];
		$project_twitter = ! isset( $meta['project_twitter'][0] ) ? '' : $meta['project_twitter'][0];
		wp_nonce_field( basename( __FILE__ ), 'project_details' ); ?>
		<table class="form-table">
			<tr>
				<td class="project_meta_box_td" colspan="2">
					<label for="project_owner"><?php _e( 'Owner', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="project_owner" class="regular-text" value="<?php echo $project_owner; ?>">
				</td>
			</tr>
			<tr>
				<td class="project_meta_box_td" colspan="2">
					<label for="project_status"><?php _e( 'Status of the project', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="checkbox" name="project_status" class="" value="<?php echo $project_status; ?>">Live
				</td>
			</tr>
			<tr>
				<td class="project_meta_box_td" colspan="2">
					<label for="project_excerpt"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="">
					<textarea name="project_excerpt" class="regular-text" value="<?php echo $project_excerpt; ?>"></textarea> 
				</td>
			</tr>
			<tr>
				<td class="project_meta_box_td" colspan="2">
					<label for="project_website"><?php _e( 'Website', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="project_website" class="regular-text" value="<?php echo $project_website; ?>">
				</td>
			</tr>
			<tr>
				<td class="project_meta_box_td" colspan="2">
					<label for="project_facebook"><?php _e( 'Facebook', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="project_facebook" class="regular-text" value="<?php echo $project_facebook; ?>">
				</td>
			</tr>
			<tr>
				<td class="project_meta_box_td" colspan="2">
					<label for="project_linkedin"><?php _e( 'LinkedIn', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="project_linkedin" class="regular-text" value="<?php echo $project_linkedin; ?>">
				</td>
			</tr>
			<tr>
				<td class="project_meta_box_td" colspan="2">
					<label for="project_twitter"><?php _e( 'Twitter', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="project_twitter" class="regular-text" value="<?php echo $project_twitter; ?>">
				</td>
			</tr>
		</table>
		<?php 
	}
	function project_detail_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$project_description = ! isset( $meta['project_description'][0] ) ? '' : $meta['project_description'][0];
		$project_launch_date = ! isset( $meta['project_launch_date'][0] ) ? '' : $meta['project_launch_date'][0];
		
		wp_nonce_field( basename( __FILE__ ), 'project_details' ); ?>
		<table class="form-table">
			<tr>
				<td class="project_meta_box_td" colspan="2">
					<label for="project_launch_date"><?php _e( 'Launch date', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="date" name="project_launch_date" class="regular-text" value="<?php echo $project_launch_date; ?>">
				</td>
			</tr>
			<tr>
				<td class="project_meta_box_td" colspan="2">
					<label for="project_description"><?php _e( 'Description', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<textarea name="project_description" class="regular-text" value="<?php echo $project_description; ?>"></textarea> 
				</td>
			</tr>
		</table>

		<?php 
	}
	function project_gallery_meta_boxes( $post ) {
		// Use nonce for verification
		?>
		<input type="hidden" name="custom_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>" />
	    <!-- Begin the field table and loop -->
	    <table id="project_gallery" class="custom_repeatable form-table">
   			<?php $meta = get_post_custom( $post->ID );?>
            <?php 
			   
			    $i = 0;
			    if ($meta) {
			        foreach($meta as $row) {
			        	?>
			        	<tr class="repeatable-row">
				        	<?php
				            echo '<td><input name="project_gallery['.$i.']" type="text" class="custom_upload_image" value="'.$image.'"/>
				                <button class="custom_upload_image_button button">Choose Image</button></td>
			                    <td><a class="repeatable-remove button" href="#">-</a><a class="repeatable-add button" href="#">Add Row</a></td>';
			                ?>
			        	</tr>
			        	<?php
			            $i++;
			        }
			    } else {
			        ?>
		        	<tr class="repeatable-row">
			        	<?php
			            echo '<td><input name="project_gallery['.$i.']" type="text" class="custom_upload_image" value="'.$image.'"/>
			                <button class="custom_upload_image_button button">Choose Image</button></td>
		                    <td><a class="repeatable-remove button" href="#">-</a><a class="repeatable-add button" href="#">Add Row</a></td>';
		                ?>
		        	</tr>
		        	<?php
	 				// echo '<a class="repeatable-add button" style="float:right" href="#">+</a>';			
			    }
			    
	        ?>
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
		if ( !isset( $_POST['project_overview'] ) || !wp_verify_nonce( $_POST['project_overview'], basename(__FILE__) ) ) {
			return $post_id;
		}
		if ( !isset( $_POST['project_details'] ) || !wp_verify_nonce( $_POST['project_details'], basename(__FILE__) ) ) {
			return $post_id;
		}
		// Check Autosave
		if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) ) {
			return $post_id;
		}
		// Don't save if only a revision
		if ( isset( $post->post_type ) && $post->post_type == 'project' ) {
			return $post_id;
		}
		// Check permissions
		if ( !current_user_can( 'edit_post', $post->ID ) ) {
			return $post_id;
		}
		$meta['project_owner'] = ( isset( $_POST['project_owner'] ) ? esc_textarea( $_POST['project_owner'] ) : '' );
		$meta['project_status'] = ( isset( $_POST['project_status'] ) ? esc_textarea( $_POST['project_status'] ) : '' );
		$meta['project_excerpt'] = ( isset( $_POST['project_excerpt'] ) ? esc_url( $_POST['project_excerpt'] ) : '' );
		$meta['project_website'] = ( isset( $_POST['project_website'] ) ? esc_textarea( $_POST['project_website'] ) : '' );
		$meta['project_facebook'] = ( isset( $_POST['project_facebook'] ) ? esc_url( $_POST['project_facebook'] ) : '' );
		$meta['project_linkedin'] = ( isset( $_POST['project_linkedin'] ) ? esc_textarea( $_POST['project_linkedin'] ) : '' );
		$meta['project_twitter'] = ( isset( $_POST['project_twitter'] ) ? esc_url( $_POST['project_twitter'] ) : '' );
		$meta['project_launch_date'] = ( isset( $_POST['project_launch_date'] ) ? esc_url( $_POST['project_launch_date'] ) : '' );
		$meta['project_description'] = ( isset( $_POST['project_description'] ) ? esc_url( $_POST['project_description'] ) : '' );
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}
	function save_custom_meta($post_id) {
	    global $custom_meta_fields;
	     
	    // verify nonce
	    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
	        return $post_id;
	    // check autosave
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
	        return $post_id;
	    // check permissions
	    if ('page' == $_POST['post_type']) {
	        if (!current_user_can('edit_page', $post_id))
	            return $post_id;
	        } elseif (!current_user_can('edit_post', $post_id)) {
	            return $post_id;
	    }
	     
	    // loop through fields and save the data
	    foreach ($custom_meta_fields as $field) {
	        $old = get_post_meta($post_id, $field['id'], true);
	        $new = $_POST[$field['id']];
	        if ($new && $new != $old) {
	            update_post_meta($post_id, $field['id'], $new);
	        } elseif ('' == $new && $old) {
	            delete_post_meta($post_id, $field['id'], $old);
	        }
	    } // end foreach
	}
}