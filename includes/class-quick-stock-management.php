<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://profiles.wordpress.org/wpboss/
 * @since      1.1.0
 *
 * @package    Quick_Stock_Management
 * @subpackage Quick_Stock_Management/includes
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
 * @since      1.1.0
 * @package    Quick_Stock_Management
 * @subpackage Quick_Stock_Management/includes
 * @author     Aslam Shekh <info.aslamshekh@gmail.com>
 */
class Quick_Stock_Management
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.1.0
     * @access   protected
     * @var      Quick_Stock_Management_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.1.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.1.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.1.0
     */
    public function __construct()
    {
        if (defined('QUICK_STOCK_MANAGEMENT_VERSION')) {
            $this->version = QUICK_STOCK_MANAGEMENT_VERSION;
        } else {
            $this->version = '1.1.0';
        }
        $this->plugin_name = 'quick-stock-management';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Quick_Stock_Management_Loader. Orchestrates the hooks of the plugin.
     * - Quick_Stock_Management_i18n. Defines internationalization functionality.
     * - Quick_Stock_Management_Admin. Defines all hooks for the admin area.
     * - Quick_Stock_Management_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.1.0
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-quick-stock-management-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-quick-stock-management-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-quick-stock-management-admin.php';

        $this->loader = new Quick_Stock_Management_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Quick_Stock_Management_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.1.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new Quick_Stock_Management_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.1.0
     * @access   private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Quick_Stock_Management_Admin($this->get_plugin_name(), $this->get_version());
        $this->loader->add_filter('manage_edit-product_columns', $plugin_admin, 'qsm_woo_add_custom_column', 20);
        $this->loader->add_filter('bulk_actions-edit-product', $plugin_admin, 'qsm_woo_register_stock_bulk_actions', 10);
        $this->loader->add_action('manage_product_posts_custom_column', $plugin_admin, 'qsm_woo_add_value_to_custom_stock', 10, 2);
        $this->loader->add_filter('handle_bulk_actions-edit-product', $plugin_admin, 'qsm_woo_stock_bulk_action_handler', 10, 3);
        $this->loader->add_action('admin_notices', $plugin_admin, 'qsm_woo_stock_bulk_action_admin_notice');
    }


    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.1.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @return    string    The name of the plugin.
     * @since     1.1.0
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Quick_Stock_Management_Loader    Orchestrates the hooks of the plugin.
     * @since     1.1.0
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @return    string    The version number of the plugin.
     * @since     1.1.0
     */
    public function get_version()
    {
        return $this->version;
    }

}
