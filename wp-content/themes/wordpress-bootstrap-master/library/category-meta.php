<?php
/**
 * DW Focus Customizer
 *
 * @package DW Focus
 * @since DW Focus 1.2.1
 */

if ( ! function_exists( 'fcom_webmedios_category_generate_html_add_form_fields' ) ) {
	function fcom_webmedios_category_generate_html_add_form_fields(){
		?>
		<div class="form-field">
			<label for="tag-style"><?php _e( 'Category Style','dw-focus' ) ?></label>
			<select name="tag-style" id="">
				<option value="none"><?php _e( 'none','dw-focus' ) ?></option>
				<option value="blue"><?php _e( 'blue','dw-focus' ) ?></option>
				<option value="cyan"><?php _e( 'cyan','dw-focus' ) ?></option>
				<option value="green"><?php _e( 'green','dw-focus' ) ?></option>
				<option value="orange"><?php _e( 'orange','dw-focus' ) ?></option>
				<option value="violet"><?php _e( 'violet','dw-focus' ) ?></option>
				<option value="yellow"><?php _e( 'yellow','dw-focus' ) ?></option>
			</select>
			<p class="description"><?php _e( 'Change style for this category','dw-focus' ); ?></p>
		</div>
		<div class="form-field">
			<label><?php _e( 'Category Logo', 'dw-focus' ); ?></label>
			<div id="category_logo" style="float:left;margin-right:10px;"><img src="" width="60px" height="60px" /></div>
			<div style="line-height:60px;">
				<input type="hidden" id="category_logo_id" name="category_logo_id" />
				<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'dw-focus' ); ?></button>
				<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'dw-focus' ); ?></button>
			</div>
		</div>
	<?php
	}
	add_action( 'category_add_form_fields', 'fcom_webmedios_category_generate_html_add_form_fields' );
}

if ( ! function_exists( 'fcom_webmedios_category_generate_html_edit_form_fields' ) ) {
	function fcom_webmedios_category_generate_html_edit_form_fields( $tag ){
		$options = fcom_webmedios_get_category_option( $tag->term_id );
		if ( $options['logo'] ) {
			$image = wp_get_attachment_thumb_url( $options['logo'] );
		}else {
			$image = '';
		}

		$colors = array( 'none', 'blue', 'cyan', 'green', 'orange', 'violet', 'yellow' );
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="tag-style">
					<?php _e( 'Category Style','dw-focus' ) ?>
				</label>
			</th>
			<td>
				<select name="tag-style" id="tag-style">
					<?php
					foreach ( $colors as $value ) {
						echo '<option '.selected( $options['style'], $value, false ).' value="'.esc_attr( $value ).'">'.esc_html( $value ).'</option>';
					}
					?>
				</select>
				<br>
				<span class="description">
					<?php _e( 'Change style for this category', 'dw-focus' ); ?>
				</span>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="tag-style">
					<?php _e( 'Category Logo','dw-focus' ) ?>
				</label>
			</th>
			<td>
				<div class="form-field">
					<label><?php _e( 'Category Logo', 'dw-focus' ); ?></label>
					<div id="category_logo" style="float:left;margin-right:10px;"><img src="<?php echo esc_url( $image );?>" width="60px" height="60px" /></div>
					<div style="line-height:60px;">
						<input type="hidden" id="category_logo_id" name="category_logo_id" value="<?php echo esc_attr( $options['logo'] ) ? esc_attr( $options['logo'] ) : '';?>" />
						<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'dw-focus' ); ?></button>
						<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'dw-focus' ); ?></button>
					</div>
				</div>
			</td>
		</tr>
		<?php
	}
	add_action( 'category_edit_form_fields', 'fcom_webmedios_category_generate_html_edit_form_fields' );
}

if ( ! function_exists( 'fcom_webmedios_enqueue_thickbox_for_edit_tag_page' ) ) {
	function fcom_webmedios_enqueue_thickbox_for_edit_tag_page(){
		global $pagenow;

		if ( 'edit-tags.php' == $pagenow ) {
			wp_enqueue_media();

			wp_register_script( 'dw-category-upload', get_template_directory_uri().'/assets/js/edit-tags.js', array( 'jquery', 'media-upload', 'thickbox' ) );

			wp_enqueue_script( 'dw-category-upload' );
		}
	}
	add_action( 'admin_print_scripts', 'fcom_webmedios_enqueue_thickbox_for_edit_tag_page' );
}

if ( ! function_exists( 'fcom_webmedios_save_category_option' ) ) {
	function fcom_webmedios_save_category_option( $category_id ){
		$category_options = array();
		if ( isset( $_POST['tag-style'] ) ) {
			$category_options['style'] = sanitize_html_class( $_POST['tag-style'] );
		}

		if ( isset( $_POST['category_logo_id'] ) ) {
			$category_options['logo'] = sanitize_key( $_POST['category_logo_id'] );
		}
		if ( ! empty( $category_options ) ) {
			update_option( 'fcom_webmedios_category_option_'.$category_id, $category_options );
		}
	}
	add_action( 'create_category', 'fcom_webmedios_save_category_option' );
	add_action( 'edit_category', 'fcom_webmedios_save_category_option' );
}

if ( ! function_exists( 'fcom_webmedios_get_category_option' ) ) {
	function fcom_webmedios_get_category_option( $category_id ){
		return get_option( 'fcom_webmedios_category_option_'.$category_id, array(
			'style'         => 'none',
			'logo'          => '',
			) );
	}
}

function fcom_webmedios_special_category_menu_class( $classes, $item ) {
	if ( 'category' == $item->object ) {
		$options = fcom_webmedios_get_category_option( $item->object_id );
		if ( 'none' != $options['style'] ) {
			$classes[] = 'color-'.$options['style'];
		}
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'fcom_webmedios_special_category_menu_class', 10, 2 );

function fcom_webmedios_category_color_class( $classes ) {
	if ( is_category() || is_single() ) {
		$category = get_the_category();
		if ( 0 == $category[0]->parent ) {
			$parent_id = $category[0]->term_id;
		} else {
			$parent_id = $category[0]->parent;
		}
		$options = fcom_webmedios_get_category_option( $parent_id );
		if ( 'none' != $options['style'] ) {
			$classes[] = 'color-'.$options['style'] ;
		}
	}

	return $classes;
}
add_filter( 'post_class', 'fcom_webmedios_category_color_class' );
add_filter( 'body_class', 'fcom_webmedios_category_color_class' );
