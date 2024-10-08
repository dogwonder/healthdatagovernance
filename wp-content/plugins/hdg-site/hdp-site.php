<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin. Based on http://wppb.io // https://github.com/DevinVinson/WordPress-Plugin-Boilerplate
 *
 * @link              https://wp.dgw.ltd
 * @since             1.0.0
 * @package           HDG_Site
 *
 * @wordpress-plugin
 * Plugin Name:       Health Data Principles: Site
 * Plugin URI:        https://wp.dgw.ltd
 * Description:       Accompanying plugin for the Sigur Rós theme
 * Version:           1.0.1
 * Author:            Dogwonder Ltd
 * Author URI:        https://richholman.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hdg-site
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin constants
 */
define( 'HDG_SITE_VERSION', '1.1.0' );
define( 'HDG_SITE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'HDG_SITE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'HDG_SITE_PLUGIN_BLOCKS', HDG_SITE_PLUGIN_DIR . 'src/blocks/' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hdg-site-activator.php
 */
function activate_hdg_site() {
	require_once HDG_SITE_PLUGIN_DIR . 'includes/class-hdg-site-activator.php';
	HDG_Site_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hdg-site-deactivator.php
 */
function deactivate_hdg_site() {
	require_once HDG_SITE_PLUGIN_DIR . 'includes/class-hdg-site-deactivator.php';
	HDG_Site_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hdg_site' );
register_deactivation_hook( __FILE__, 'deactivate_hdg_site' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require HDG_SITE_PLUGIN_DIR . 'includes/class-hdg-site.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hdg_site() {

	$plugin = new HDG_Site();
	$plugin->run();

}
run_hdg_site();
