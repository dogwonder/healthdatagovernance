<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wp.dgw.ltd
 * @since      1.0.0
 *
 * @package    HDG_Site
 * @subpackage HDG_Site/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    HDG_Site
 * @subpackage HDG_Site/admin
 * @author     Rich Holman <dogwonder@gmail.com>
 */
class HDG_Site_Admin {

	/**
	 * The ID of this plugin.
	 *

	 * @access   private
	 * @var      string    $HDG_Site    The ID of this plugin.
	 */
	private $HDG_Site;

	/**
	 * The version of this plugin.
	 *

	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *

	 * @param      string $HDG_Site       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $HDG_Site, $version ) {

		$this->HDG_Site = $HDG_Site;
		$this->version       = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 */
	public function hdg_enqueue_admin_styles() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in HDG_Site_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The HDG_Site_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->HDG_Site, plugin_dir_url( __FILE__ ) . 'css/hdg-site-editor.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 */
	public function hdg_enqueue_admin_scripts() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in HDG_Site_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The HDG_Site_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->HDG_Site, plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );
	}

}
