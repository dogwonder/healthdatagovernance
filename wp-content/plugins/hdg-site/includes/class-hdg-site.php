<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://wp.dgw.ltd
 * @since      1.0.0
 *
 * @package    HDG_Site
 * @subpackage HDG_Site/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    HDG_Site
 * @subpackage HDG_Site/includes
 * @author     Rich Holman <dogwonder@gmail.com>
 */
class HDG_Site {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *

	 * @access   protected
	 * @var      HDG_Site_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *

	 * @access   protected
	 * @var      string    $HDG_Site    The string used to uniquely identify this plugin.
	 */
	protected $HDG_Site;

	/**
	 * The current version of the plugin.
	 *

	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 */
	public function __construct() {
		if ( defined( 'HDG_SITE_VERSION' ) ) {
			$this->version = HDG_SITE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->HDG_Site = 'hdg-site';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_acf_hooks();
		$this->define_site_rules();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - HDG_Site_Loader. Orchestrates the hooks of the plugin.
	 * - HDG_Site_I18n. Defines internationalization functionality.
	 * - HDG_Site_Admin. Defines all hooks for the admin area.
	 * - HDG_Site_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *

	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once HDG_SITE_PLUGIN_DIR . 'includes/class-hdg-site-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once HDG_SITE_PLUGIN_DIR . 'includes/class-hdg-site-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once HDG_SITE_PLUGIN_DIR . 'admin/class-hdg-site-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once HDG_SITE_PLUGIN_DIR . 'public/class-hdg-site-public.php';

		/**
		 * The class responsible for defining all actions that occur for building out the custom blocks
		 */
		require_once HDG_SITE_PLUGIN_DIR . 'includes/class-hdg-site-acf.php';

		/**
		 * The class responsible for defining all actions that occur for building out the custom rules
		 */
		require_once HDG_SITE_PLUGIN_DIR . 'includes/class-hdg-site-rules.php';

		$this->loader = new HDG_Site_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the HDG_Site_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *

	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new HDG_Site_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *

	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new HDG_Site_Admin( $this->get_hdg_Site(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'hdg_enqueue_admin_styles' );
		// $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'hdg_enqueue_admin_scripts' );

		
	}

	/**
	 * Register all of the hooks related to the ACF blocks area functionality
	 * of the plugin.
	 *

	 * @access   private
	 */
	private function define_acf_hooks() {

		$plugin_acf = new HDG_Site_ACF();

		// $this->loader->add_action( 'init', $plugin_acf, 'hdg_register_wp_block_scripts');
		$this->loader->add_action( 'init', $plugin_acf, 'hdg_register_wp_blocks' );
		// $this->loader->add_action( 'init', $plugin_acf, 'hdg_acf_get_blocks' );
		$this->loader->add_action( 'init', $plugin_acf, 'hdg_register_options_page' );

		$this->loader->add_filter( 'acf/json/load_paths', $plugin_acf, 'hdg_acf_json_load_paths' );
		$this->loader->add_filter( 'acf/settings/save_json/type=acf-field-group', $plugin_acf, 'hdg_acf_json_save_path_for_field_groups' );
		$this->loader->add_filter( 'acf/settings/save_json/type=acf-ui-options-page', $plugin_acf, 'hdg_acf_json_save_path_for_option_pages' );
		$this->loader->add_filter( 'acf/settings/save_json/type=acf-post-type', $plugin_acf, 'hdg_acf_json_save_path_for_post_types' );
		$this->loader->add_filter( 'acf/settings/save_json/type=acf-taxonomy', $plugin_acf, 'hdg_acf_json_save_path_for_taxonomies' );
		$this->loader->add_filter( 'acf/json/save_file_name', $plugin_acf, 'hdg_acf_json_filename', 10, 3 );

		$this->loader->add_filter('acf/prepare_field/name=featured_card_id', $plugin_acf, 'hdg_acf_field_wrapper_class');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *

	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new HDG_Site_Public( $this->get_hdg_Site(), $this->get_version() );

		$this->loader->add_filter('script_loader_tag', $plugin_public, 'hdg_add_type_attribute', 10, 3);

		// We load these in the theme, so we don't need these in this instance
		// $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'hdg_enqueue_theme_styles' );

		// Load theme scripts
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'hdg_enqueue_theme_scripts' );


	}

	
	/**
	 * Register all of the hooks related to the ACF blocks area functionality
	 * of the plugin.
	 *

	 * @access   private
	 */
	private function define_site_rules() {

		$plugin_rules = new HDG_Site_Rules();

		/**
 		* Allow-list the block types available in the inserter.
 		*/
		// $this->loader->add_filter( 'allowed_block_types_all', $plugin_rules, 'hdg_register_block_rules' );

		/**
 		* Apply user filters to theme.json data.
 		*/
		$this->loader->add_action( 'after_setup_theme', $plugin_rules, 'hdg_apply_theme_json_user_filters' );

		
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_hdg_Site() {
		return $this->HDG_Site;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    HDG_Site_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
