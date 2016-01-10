<?php
/**
 * Various functions used by the plugin.
 *
 * @package    FCOM_Maps
 * @since      0.9.4
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Sets up the default arguments.
 *
 * @since  0.9.4
 */
function fcom_get_default_args() {

	$defaults = array(
		'height'     => 900,
		'width'      => 450,
	);

	// Allow plugins/themes developer to filter the default arguments.
	return apply_filters( 'fcom_default_args', $defaults );

}
