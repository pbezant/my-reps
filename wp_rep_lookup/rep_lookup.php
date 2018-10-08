<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.PrestonBezant.com
 * @since             1.0.0
 * @package           Rep_lookup
 *
 * @wordpress-plugin
 * Plugin Name:       Rep Lookup
 * Plugin URI:        https://github.com/pbezant/my-reps
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Preston Bezant
 * Author URI:        www.PrestonBezant.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rep_lookup
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rep_lookup-activator.php
 */
function activate_rep_lookup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rep_lookup-activator.php';
	Rep_lookup_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rep_lookup-deactivator.php
 */
function deactivate_rep_lookup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rep_lookup-deactivator.php';
	Rep_lookup_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rep_lookup' );
register_deactivation_hook( __FILE__, 'deactivate_rep_lookup' );

function rep_page_shortcode(){
	include 'public/partials/rep_lookup-public-display.php';
}
add_shortcode('rep-page', 'rep_page_shortcode');
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rep_lookup.php';

// function rep_lookup_add_settings_link( $links ) {
//     $settings_link =  '<a href="'.admin_url('admin.php?page=rep_lookup').'">'.__('Settings').'</a>';
//     array_push( $links, $settings_link );
//   	return $links;
// }

// add_filter( "plugin_action_links_".plugin_basename( __FILE__ ), 'rep_lookup_add_settings_link' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rep_lookup() {

	$plugin = new Rep_lookup();
	$plugin->run();

}
run_rep_lookup();
