<?php 
function Notes_meta_box() {

    add_meta_box(
        'Notes-notice',
        __( 'Notes Notice', 'sitepoint' ),
        'Notes_notice_meta_box_callback',
        'Notes'
    );
}

add_action( 'add_meta_boxes', 'Notes_meta_box' );

function Notes_notice_meta_box_callback(){
	global $post;
	wp_nonce_field( basename(__FILE__), 'global_Notes_nonce' );
	$Notes_stored = get_post_meta($post->ID);
	?>
		<div class="wrap Notes-form">
			<div class="form-group">
				<label for="prioity"><?php esc_html_e('Prioity','Notes-textdomin') ?></label>
				<select name="prioity" id="prioity">
					<?php 
						$options_values = array('low','normal','high');
						foreach ($options_values as $value) {
							if($value == $Notes_stored['prioity'][0]){
								?>
									<option selected><?php echo $value; ?></option>
								<?php
							}else{
								?>
									<option><?php echo $value; ?></option>
								<?php
							}
						}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="detalies"><?php esc_html_e('detalies','Notes-textdomin') ?></label>
				<?php 
					$content = get_post_meta( $post->ID, 'detalies', true );
					$editor = 'detalies';
					$settings = array(
						'textarea_rows' => 5,
						'media_buttos'  => true
					);
					wp_editor($content,$editor,$settings); 
				?>
			</div>
		</div>

		<div class="form-group">
			<label for="due-date"><?php esc_html_e('due date','Notes-textdomin') ?></label>
			<input type="date" name="due-date" id="due-date" value="<?php if(!empty($Notes_stored['due-date'])){echo esc_attr($Notes_stored['due-date'][0]);}?>">
		</div>
	<?php
}


function wpt_save_notes_meta( $post_id, $post ) {
	$is_autosave = wp_is_post_autosave($post_id);
	$is_revesion = wp_is_post_revision($post_id);
	$is_nonce    = (isset($_POST['global_Notes_nonce'] )) || ! wp_verify_nonce( $_POST['global_Notes_nonce'], basename(__FILE__) );
	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['global_Notes_nonce'] ) || ! wp_verify_nonce( $_POST['global_Notes_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}

		if ( $is_autosave || $is_revesion || !$is_nonce ) {
			return;
		}
		if (isset($_POST['prioity']) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, 'prioity', sanitize_text_field($_POST['prioity']) );
		}
		if (isset($_POST['detalies']) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, 'detalies',sanitize_text_field($_POST['detalies']) );
		}
		if (isset($_POST['due-date']) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, 'due-date', sanitize_text_field($_POST['due-date']) );
		}				
}
add_action( 'save_post', 'wpt_save_notes_meta', 1, 2 );