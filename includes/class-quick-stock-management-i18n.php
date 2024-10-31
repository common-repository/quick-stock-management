<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://profiles.wordpress.org/wpboss/
 * @since      1.1.0
 *
 * @package    Quick_Stock_Management
 * @subpackage Quick_Stock_Management/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.1.0
 * @package    Quick_Stock_Management
 * @subpackage Quick_Stock_Management/includes
 * @author     Aslam Shekh <info.aslamshekh@gmail.com>
 */
class Quick_Stock_Management_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.1.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'quick-stock-management',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
