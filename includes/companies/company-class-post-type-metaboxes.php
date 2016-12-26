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
class Companies_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'companies_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
	}

	/**
	 * Register the metaboxes to be used for the investment post type
	 *
	 * @since 0.1.0
	 */
	public function companies_meta_boxes() {
		add_meta_box(
			'companies_overview',
			'Company Overview',
			array( $this, 'companies_overview_meta_boxes' ),
			'Companies',
			'normal',
			'high'
		);
		add_meta_box(
			'companies_details',
			'Company Details',
			array( $this, 'companies_detail_meta_boxes' ),
			'Companies',
			'normal',
			'high'
		);
		add_meta_box( 
	        'company_project_taxonomy', 
	        'Company Project',
	        array( $this, 'company_project_taxonomy' ),// $callback
	        'Companies', 
	        'normal', 
	        'high' 
	    );
	    add_meta_box( 
	        'company_offices', 
	        'Offices/Locations',
	        array( $this, 'company_offices' ),// $callback
	        'Companies', 
	        'normal', 
	        'high' 
	    );
	    add_meta_box( 
	        'company_current_team', 
	        'Current Team',
	        array( $this, 'company_current_team' ),// $callback
	        'Companies', 
	        'normal', 
	        'high' 
	    );
	    add_meta_box( 
	        'company_past_team', 
	        'Past Team',
	        array( $this, 'company_past_team' ),// $callback
	        'Companies', 
	        'normal', 
	        'high' 
	    );
	    add_meta_box( 
	        'company_board_member', 
	        'Board Members and Advisors',
	        array( $this, 'company_board_member' ),// $callback
	        'Companies', 
	        'normal', 
	        'high' 
	    );
	    add_meta_box( 
	        'company_sub_organization', 
	        'Sub Organizations',
	        array( $this, 'company_sub_organization' ),// $callback
	        'Companies', 
	        'normal', 
	        'high' 
	    );
	    add_meta_box( 
	        'company_competitor', 
	        'Competitors',
	        array( $this, 'company_competitor' ),// $callback
	        'Companies', 
	        'normal', 
	        'high' 
	    );
		add_meta_box( 
	        'company_gallery', 
	        'Gallery',
	        array( $this, 'company_gallery' ),// $callback
	        'Companies', 
	        'normal', 
	        'high', 
	        array( 'id' => 'company_gallery') 
	    );
	   

	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function companies_overview_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		$companies_fund_raised = ! isset( $meta['companies_fund_raised'][0] ) ? '' : $meta['companies_fund_raised'][0];
		$companies_excerpt = ! isset( $meta['companies_excerpt'][0] ) ? '' : $meta['companies_excerpt'][0];
		$companies_website = ! isset( $meta['companies_website'][0] ) ? '' : $meta['companies_website'][0];
		$companies_website_url = ! isset( $meta['companies_website_url'][0] ) ? '' : $meta['companies_website_url'][0];
		$companies_facebook = ! isset( $meta['companies_facebook'][0] ) ? '' : $meta['companies_facebook'][0];
		$companies_linkedin = ! isset( $meta['companies_linkedin'][0] ) ? '' : $meta['companies_linkedin'][0];
		$companies_twitter = ! isset( $meta['companies_twitter'][0] ) ? '' : $meta['companies_twitter'][0];
		$companies_founder = !isset($meta['companies_founder'][0] ) ? '' : $meta['companies_founder'][0];
		$companies_headquarter =!isset($meta['companies_headquarter'][0] ) ? '' : $meta['companies_headquarter'][0]; 
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
					<label for="companies_headquarter"><?php _e( 'Headquarter', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<?php
					    $loc_query = new WP_Query( 'post_type=location' );
					    if ( $loc_query->have_posts() ) {
					       	echo '<select name="companies_headquarter" class="regular-text">';
							    while ( $loc_query->have_posts() ) {
							        $loc_query->the_post();
								        $loc_id = get_the_ID();
								        $loc_selected = "";
								       	if($companies_headquarter){
									        if($loc_id == $companies_headquarter){
									            $loc_selected = 'selected';
									        }
								       	}
										echo '<option value="'.$loc_id.'" '.$loc_selected.'>'. get_the_title() .'</option>';
							    }
							echo '</select>';		
						}	
					?>
				</td>
			</tr>
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_excerpt"><?php _e( 'Excerpt', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<textarea name="companies_excerpt" class="regular-text" cols="100" rows="4"><?php echo $companies_excerpt; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_founder"><?php _e( 'Founder', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<?php
					    $po_query = new WP_Query( 'post_type=people' );
					    if ( $po_query->have_posts() ) {
					       	echo '<select name="companies_founder" class="regular-text">';
							    while ( $po_query->have_posts() ) {
							        $po_query->the_post();
								        $people_id = get_the_ID();
								        $pe_selected = "";
								       	if($companies_founder){
									        if($people_id == $companies_founder){
									            $pe_selected = 'selected';
									        }
								       	}
										echo '<option value="'.$people_id.'" '.$pe_selected.'>'. get_the_title() .'</option>';
							    }
							echo '</select>';		
						}	
					?>
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
					<label for="companies_website_url"><?php _e( 'Website Url', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="companies_website_url" class="regular-text" value="<?php echo $companies_website_url; ?>">
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
	function companies_detail_meta_boxes( $post ) {
		$meta = get_post_custom( $post->ID );
		$companies_founded = ! isset( $meta['companies_founded'][0] ) ? '' : $meta['companies_founded'][0];
		$companies_contact = ! isset( $meta['companies_contact'][0] ) ? '' : $meta['companies_contact'][0];
		$companies_employees = ! isset( $meta['companies_employees'][0] ) ? '' : $meta['companies_employees'][0];
		// $companies_description = ! isset( $meta['companies_description'][0] ) ? '' : $meta['companies_description'][0];
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
			<!-- <tr>
				<td class="companies_meta_box_td" colspan="2">
					<label for="companies_description"><?php _e( 'Description', 'biznews' ); ?>
					</label>
				</td>
				<td colspan="4">
				<textarea name="companies_description" class="regular-text" cols="100" rows="16"><?php echo $companies_description; ?></textarea>
				</td>
			</tr> -->
		</table>

		<?php 
	}
	function company_project_taxonomy( $post , $args ){
		wp_nonce_field( basename( __FILE__ ), 'company_project_taxonomy' ); 
	    $query = new WP_Query( 'post_type=project' );
	    if ( $query->have_posts() ) {
		    while ( $query->have_posts() ) {
		        $query->the_post();
		    	$p_taxonomy_id = get_post_meta($post->ID, 'company_project_taxonomy', true);
		    	// print_r($p_taxonomy_id);
		        $id = get_the_ID();
		        $selected = "";
		       	if($p_taxonomy_id){
			        if(in_array($id, $p_taxonomy_id)){
			            $selected = 'checked';
			        }
		       	}
		        echo '<input name="company_project_taxonomy[]" type="checkbox" id="company_project_taxonomy"' . $selected . ' value="' . $id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function company_offices($post){
		echo '<table class="form-table">';
		    $index = 0;
		    $company_offices = 'company_offices';
			$meta = get_post_custom( $post->ID );
			while($meta[$company_offices.'_'.$index]) {
				$company_offices.'_'.$index;
	        	$company_office_meta[] = get_post_meta( $post->ID,$company_offices.'_'.$index, FALSE );
		  		$index++;
			}
			wp_nonce_field( basename( __FILE__ ), 'company_gallery' ); 
	        echo '<tr>
                <th><label for="company_offices">Repeatable</label></th>
                <td>';
					    echo '<a class="repeatable-add button" href="#">+</a>
					            <ul id="company_offices_ul" class="custom_repeatable">';
				    	$i = 0;
					    if ($company_office_meta) {
					        foreach($company_office_meta as $row) {
					        	foreach ($row as $val) {
			                        echo '<li><span class="sort hndle">|||</span>
						                <input name="company_offices'.$i.'" type="text" id="company_offices" class="custom_upload_image" value="'.$val.'"/>
						                <button class="custom_upload_image_button button">Choose Image</button>
					                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
					                    <a class="repeatable-remove button" href="#">-</a></li>';
					        	}
					            $i++;
					        }
					    } else {
				         	echo '<li><span class="sort hndle">|||</span>
						                <input name="company_offices'.$i.'" type="text" id="company_offices" class="custom_upload_image" value="'.$val.'"/>
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
	function company_current_team( $post , $args ){
		$companies_current_team =  get_post_meta($post->ID, 'companies_current_team', true);
		$team_query = new WP_Query( 'post_type=people' );
	    if ( $team_query->have_posts() ) {
		    while ( $team_query->have_posts() ) {
		        $team_query->the_post();
		        $team_id = get_the_ID();
		        $team_selected = "";
		       	if($companies_current_team){
			        if(in_array($team_id, $companies_current_team)){
			            $team_selected = 'checked';
			        }
		       	}
		        echo '<input name="companies_current_team[]" type="checkbox" id="companies_current_team"' . $team_selected . ' value="' . $team_id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function company_past_team( $post , $args ){
		$companies_past_team =  get_post_meta($post->ID, 'companies_past_team', true);
		$p_team_query = new WP_Query( 'post_type=people' );
	    if ( $p_team_query->have_posts() ) {
		    while ( $p_team_query->have_posts() ) {
		        $p_team_query->the_post();
		        $p_team_id = get_the_ID();
		        $p_team_selected = "";
		       	if($companies_past_team){
			        if(in_array($p_team_id, $companies_past_team)){
			            $p_team_selected = 'checked';
			        }
		       	}
		        echo '<input name="companies_past_team[]" type="checkbox" id="companies_past_team"' . $p_team_selected . ' value="' . $p_team_id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function company_board_member( $post , $args ){
		$company_board_member =  get_post_meta($post->ID, 'company_board_member', true);
		$b_member_query = new WP_Query( 'post_type=people');		
	    if ( $b_member_query->have_posts() ) {
		    while ( $b_member_query->have_posts() ) {
		        $b_member_query->the_post();
		        $b_member_id = get_the_ID();
		        $b_member_selected = "";
		       	if($company_board_member){
			        if(in_array($b_member_id, $company_board_member)){
			            $b_member_selected = 'checked';
			        }
		       	}
		        echo '<input name="company_board_member[]" type="checkbox" id="company_board_member"' . $b_member_selected . ' value="' . $b_member_id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function company_sub_organization( $post , $args ){
		$company_sub_organization =  get_post_meta($post->ID, 'company_sub_organization', true);
		$sub_o_query = new WP_Query( array( 'post_type' => 'companies', 'post__not_in' => array( $post->ID ) ) );
	    if ( $sub_o_query->have_posts() ) {
		    while ( $sub_o_query->have_posts() ) {
		        $sub_o_query->the_post();
		        $sub_o_id = get_the_ID();
		        $sub_o_selected = "";
		       	if($company_sub_organization){
			        if(in_array($sub_o_id, $company_sub_organization)){
			            $sub_o_selected = 'checked';
			        }
		       	}
		        echo '<input name="company_sub_organization[]" type="checkbox" id="company_sub_organization"' . $sub_o_selected . ' value="' . $sub_o_id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function company_competitor( $post , $args ){
		$company_competitor =  get_post_meta($post->ID, 'company_competitor', true);
		$com_query = new WP_Query( array( 'post_type' => 'companies', 'post__not_in' => array( $post->ID ) ) );
	    if ( $com_query->have_posts() ) {
		    while ( $com_query->have_posts() ) {
		        $com_query->the_post();
		        $com_id = get_the_ID();
		        $com_selected = "";
		       	if($company_competitor){
			        if(in_array($com_id, $company_competitor)){
			            $com_selected = 'checked';
			        }
		       	}
		        echo '<input name="company_competitor[]" type="checkbox" id="company_competitor"' . $com_selected . ' value="' . $com_id . '" >' . get_the_title() .'<br/>';
		    }
		}
	}
	function company_gallery($post){
	    echo '<table class="form-table">';
	        // get value of this field if it exists for this post
		    $index = 0;
		    $company_repeatable = 'company_repeatable';
			$meta = get_post_custom( $post->ID );
			while($meta[$company_repeatable.'_'.$index]) {
				$company_repeatable.'_'.$index;
	        	$company_meta[] = get_post_meta( $post->ID,$company_repeatable.'_'.$index, FALSE );
		  		$index++;
			}
			wp_nonce_field( basename( __FILE__ ), 'company_gallery' ); 
			// print_r($company_meta);
	        echo '<tr>
                <th><label for="company_repeatable">Repeatable</label></th>
                <td>';
					    echo '<a class="repeatable-add button" href="#">+</a>
					            <ul id="company_repeatable_ul" class="custom_repeatable">';
				    	$i = 0;
					    if ($company_meta) {
					        foreach($company_meta as $row) {
					        	foreach ($row as $val) {
			                        echo '<li><span class="sort hndle">|||</span>
						                <input name="company_repeatable_'.$i.'" type="text" id="company_repeatable" class="custom_upload_image" value="'.$val.'"/>
						                <button class="custom_upload_image_button button">Choose Image</button>
					                    <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
					                    <a class="repeatable-remove button" href="#">-</a></li>';
					        	}
					            $i++;
					        }
					    } else {
				         	echo '<li><span class="sort hndle">|||</span>
						                <input name="company_repeatable_'.$i.'" type="text" id="company_repeatable" class="custom_upload_image" value="'.$val.'"/>
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
		$meta['companies_website_url'] = ( isset( $_POST['companies_website_url'] ) ? esc_textarea($_POST['companies_website_url']) : '' );
		$meta['companies_facebook'] = ( isset( $_POST['companies_facebook'] ) ? esc_url($_POST['companies_facebook'] ): '' );
		$meta['companies_linkedin'] = ( isset( $_POST['companies_linkedin'] ) ? esc_url($_POST['companies_linkedin'] ): '' );
		$meta['companies_twitter'] = ( isset( $_POST['companies_twitter'] ) ? esc_url($_POST['companies_twitter'] ): '' );
		$meta['companies_founded'] = ( isset( $_POST['companies_founded'] ) ? esc_textarea($_POST['companies_founded']) : '' );
		$meta['companies_contact'] = ( isset( $_POST['companies_contact'] ) ? esc_textarea($_POST['companies_contact'] ): '' );
		$meta['companies_employees'] = ( isset( $_POST['companies_employees'] ) ? esc_textarea($_POST['companies_employees'] ): '' );
		$meta['company_project_taxonomy'] = ( isset( $_POST['company_project_taxonomy'] ) ? $_POST['company_project_taxonomy'] : '' );
		$meta['companies_founder'] = ( isset( $_POST['companies_founder'] ) ? $_POST['companies_founder'] : '' );
		$meta['companies_headquarter'] = ( isset( $_POST['companies_headquarter'] ) ? $_POST['companies_headquarter'] : '' );
		$meta['companies_current_team'] = ( isset( $_POST['companies_current_team'] ) ? $_POST['companies_current_team'] : '' );
		$meta['companies_past_team'] = ( isset( $_POST['companies_past_team'] ) ? $_POST['companies_past_team'] : '' );
		$meta['company_board_member'] = ( isset( $_POST['company_board_member'] ) ? $_POST['company_board_member'] : '' );
		$meta['company_sub_organization'] = ( isset( $_POST['company_sub_organization'] ) ? $_POST['company_sub_organization'] : '' );
		$meta['company_competitor'] = ( isset( $_POST['company_competitor'] ) ? $_POST['company_competitor'] : '' );
		$company_repeatable = 'company_repeatable';
	    $index = 0;
		while(isset($_POST[$company_repeatable.'_'.$index])) {
			$meta[$company_repeatable.'_'.$index] = ( isset( $_POST[$company_repeatable.'_'.$index] ) ? $_POST[$company_repeatable.'_'.$index] : '' );
	  		$index++;
		}
		foreach ( $meta as $key => $value ) {
				update_post_meta( $post->ID, $key, $value );	
		}
	}
}
