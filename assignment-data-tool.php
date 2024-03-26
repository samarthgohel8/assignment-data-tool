<?php
/*
Plugin Name: Assignment Data Management Tool

Plugin URI: company.xyz

Description: Tool to manage assignment data. 
Author: samarth

Text Domain: assignment-data-tool

Domain Path: /languages

Version: 1.0

Since: 1.0

Requires WordPress Version at least: 4.1

*/

// Exit if accessed directly

if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
}

/**
 * Assignment_Data_Tool class.
 */

 class Assignment_Data_Tool {
	/**
	 * The single instance of the class.
	 *
	 * @var self
	 */
	private static $_instance = null;

	/**
	 * Main Assignment Data Management Tool Instance.
	 *
	 * Ensures only one instance of Assignment Data Management Tool is loaded or can be loaded.
	 *
	 * @static
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor - get the plugin hooked in and ready
	 */

	 public function __construct() 
	 {
		// Define constants
		define( 'ASSIGNMENT_DATA_TOOL_VERSION', '1.0' );
		define( 'ASSIGNMENT_DATA_TOOL_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
		define( 'ASSIGNMENT_DATA_TOOL_PLUGIN_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );

		add_action('wp_enqueue_scripts', [$this,'adt_enqueue_styles'],0);

		//Inclue Core files		
		include( 'inc/adt-post-types.php' );
		include( 'inc/adt-shortcodes.php' );

		
	 }

	 /**
	  * Enqueue Styles
	  */
	  public function adt_enqueue_styles(){
		wp_enqueue_style('adt-style', plugins_url('assets/css/style.css', __FILE__), array(), ASSIGNMENT_DATA_TOOL_VERSION , 'all');
	  }

 }


new Assignment_Data_Tool();