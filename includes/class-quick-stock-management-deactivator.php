<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://profiles.wordpress.org/wpboss/
 * @since      1.1.0
 *
 * @package    Quick_Stock_Management
 * @subpackage Quick_Stock_Management/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.1.0
 * @package    Quick_Stock_Management
 * @subpackage Quick_Stock_Management/includes
 * @author     Aslam Shekh <info.aslamshekh@gmail.com>
 */
class Quick_Stock_Management_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.1.0
	 */
	public static function deactivate() {
        flush_rewrite_rules();
	}

}
