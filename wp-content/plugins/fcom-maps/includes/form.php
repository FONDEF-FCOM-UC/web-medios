<?php
/**
 * Widget forms.
 *
 * @package    FCOM_Map_Widget
 * @since      0.9.4
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
	<p>
		Ancho: <input class="small-input" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['width'] ); ?>"/>
		Alto: <input class= "small-input" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['height'] ); ?>" /><br>
	</p>
