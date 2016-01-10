<?php
/**
 * The custom recent posts widget.
 * This widget gives total control over the output to the user.
 *
 * @package    Recent_Posts_Widget_Extended
 * @since      0.1
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */
class FCOM_Map_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 0.1
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname'   => 'fcom_map_widget',
			'description' => __( 'Despliega el mapa para visualizar las entradas.', 'fcom-map-widget' )
		);

		$control_options = array(
		);

		/* Create the widget. */
		parent::__construct(
			'fcom_map_widget',                                             // $this->id_base
			__( 'FCOM Maps', 'fcom-map-widget' ),                          // $this->name
			$widget_options,                                               // $this->widget_options
			$control_options                                               // $this->control_options
		);

	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {  
	
	    if ( empty( $instance['width'] ) && empty( $instance['height'] ) ) {
		    echo '<div id="fcom-mapa" style="width:930px;height:450px;"></div>';
        } else
        {
            echo '<div id="fcom-mapa" style="width:'.$instance['width'].'px;height:'.$instance['height'].'px;"></div>';
        }
        wp_enqueue_style('fcom-tags-mapa-css', plugins_url('/css/fcom_mapa.css', __FILE__));
        wp_enqueue_script('jquery-js', plugins_url('/js/jquery-2.1.4.min.js', __FILE__));
        wp_enqueue_script('d3-js', plugins_url('/js/d3.min.js', __FILE__));
        wp_enqueue_script('functions-js', plugins_url('/js/functions.js', __FILE__));
        wp_enqueue_script('fcom_mapa-js', plugins_url('/js/fcom_mapa.ribbon.js', __FILE__));
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, fcom_get_default_args() );

		// Extract the array to allow easy use of variables.
		extract( $instance );

		// Loads the widget form.
		include( FCOM_INCLUDES . 'form.php' );
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {

        // Validate post_type submissions
		$name = get_post_types( array( 'public' => true ), 'names' );
		$types = array();
		foreach( $new_instance['post_type'] as $type ) {
			if ( in_array( $type, $name ) ) {
				$types[] = $type;
			}
		}
		if ( empty( $types ) ) {
			$types[] = 'post';
		}

		$instance                     = $old_instance;

		$instance['height']     = (int)( $new_instance['height'] );
		$instance['width']      = (int)( $new_instance['width'] );

		return $instance;
	}
}
