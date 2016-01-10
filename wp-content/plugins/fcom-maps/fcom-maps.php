<?php
/*
Plugin Name: Fcom Map plugin
Plugin URI:  http://
Description: Plugin que crea mapa
Version:     
Author:      Diego Gomez
Author URI:  https://github.com/dgzara
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: fcom-tags
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class FCOM_Maps {

    /**
     * PHP5 constructor method.
     *
     * @since  0.1
     */
    public function __construct() {

	    // Set the constants needed by the plugin.
	    add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );
        
        // Load the functions files.
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 2 );
		
	    // Register widget.
	    add_action( 'widgets_init', array( &$this, 'register_widget' ) );

	    // Add assets
	    add_action( 'init', array( &$this, 'fcom_check_widget' ) );
    }

    /**
	 * Defines constants used by the plugin.
	 *
	 * @since  0.1
	 */
	public function constants() {

		// Set constant path to the plugin directory.
		define( 'FCOM_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		// Set the constant path to the plugin directory URI.
		define( 'FCOM_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

        // Set the constant path to the includes directory.
		define( 'FCOM_INCLUDES', FCOM_DIR . trailingslashit( 'includes' ) );
	}
	
	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since  0.1
	 */
	public function includes() {
		require_once( FCOM_INCLUDES . 'functions.php' );
	}
	
    /**
	 * Register the widget.
	 *
	 * @since  0.9.1
	 */
	public function register_widget() {
		require_once( FCOM_DIR . 'widget.php' );
		require_once( FCOM_DIR . 'json.php');
		register_widget( 'FCOM_Map_Widget' );
	}
	
	/**
	 * Add assets
	 *
	 * @since  0.9.4
	 */
    function fcom_check_widget() {
        if( is_active_widget( '', '', 'fcom_tags_widget' ) ) {
            wp_enqueue_style('fcom-tags-mapa-css', plugins_url('/css/fcom_mapa.css', __FILE__));
            wp_enqueue_script('jquery-js', plugins_url('/js/jquery-2.1.4.min.js', __FILE__));
            wp_enqueue_script('d3-js', plugins_url('/js/d3.min.js', __FILE__));
            wp_enqueue_script('functions-js', plugins_url('/js/functions.js', __FILE__));
        }
    }
}


new FCOM_Maps;
