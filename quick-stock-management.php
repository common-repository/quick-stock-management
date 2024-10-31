<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://profiles.wordpress.org/wpboss/
 * @since             1.1.0
 * @package           Quick_Stock_Management
 *
 * @wordpress-plugin
 * Plugin Name:       Quick Stock Management
 * Plugin URI:        https://profiles.wordpress.org/wpboss/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.1.0
 * Author:            Aslam Shekh
 * Author URI:        https://profiles.wordpress.org/wpboss/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       quick-stock-management
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.1.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('QUICK_STOCK_MANAGEMENT_VERSION', '1.1.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-quick-stock-management-activator.php
 */
function activate_quick_stock_management()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-quick-stock-management-activator.php';
    Quick_Stock_Management_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-quick-stock-management-deactivator.php
 */
function deactivate_quick_stock_management()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-quick-stock-management-deactivator.php';
    Quick_Stock_Management_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_quick_stock_management');
register_deactivation_hook(__FILE__, 'deactivate_quick_stock_management');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-quick-stock-management.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.1.0
 */
function run_quick_stock_management()
{

    $plugin = new Quick_Stock_Management();
    $plugin->run();

}

run_quick_stock_management();
