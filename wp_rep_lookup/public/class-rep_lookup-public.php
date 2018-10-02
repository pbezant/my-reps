<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.PrestonBezant.com
 * @since      1.0.0
 *
 * @package    Rep_lookup
 * @subpackage Rep_lookup/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rep_lookup
 * @subpackage Rep_lookup/public
 * @author     Preston Bezant <me@prestonbezant.com>
 */
class Rep_lookup_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rep_lookup_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rep_lookup_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', array(),'', 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rep_lookup.css', array(), '', 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rep_lookup_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rep_lookup_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'bootstrap', "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js", array('jquery') , '', false );


		$api_key = AIzaSyDoZS07ZPfGy8HYYYwIvYE2Pa_Is0mCFZI;
		wp_enqueue_script( 'google_places', "https://maps.google.com/maps/api/js?libraries=places&key=".$api_key.'', '', false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rep_lookup.js', array( 'jquery' ), '', false );

	}

	public function enqueue_bootstrap(){
		


	}

}
