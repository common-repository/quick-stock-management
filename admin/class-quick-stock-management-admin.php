<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/wpboss/
 * @since      1.1.0
 *
 * @package    Quick_Stock_Management
 * @subpackage Quick_Stock_Management/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Quick_Stock_Management
 * @subpackage Quick_Stock_Management/admin
 * @author     Aslam Shekh <info.aslamshekh@gmail.com>
 */
class Quick_Stock_Management_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.1.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.1.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.1.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Add Column label for the bulk stock update
     * @param $columns_array
     * @return mixed
     */
    public function qsm_woo_add_custom_column($columns_array)
    {
        $columns_array['qsm_woo_qty'] = __('Quantity', 'quick-stock-management');
        return $columns_array;
    }

    /**
     * Add bulk update option in bulk dropdwon
     * @param $bulk_actions
     * @return mixed
     */
    public function qsm_woo_register_stock_bulk_actions($bulk_actions)
    {
        $bulk_actions['qsm_woo_stock_update'] = __('Stock Update', 'quick-stock-management');
        return $bulk_actions;
    }

    /**
     * Add Column field for the bulk stock update
     * @param $column_name
     * @param $post_id
     */
    public function qsm_woo_add_value_to_custom_stock($column_name, $post_id)
    {

        $qsm_woo_qty = get_post_custom($post_id);
        switch ($column_name) {
            case 'qsm_woo_qty' :
                $currentExistingValue = isset($qsm_woo_qty['_stock'][0]) ? $qsm_woo_qty['_stock'][0] : "";
                echo '<div><input type="number" style="width: 100%" name="qsm_woo_qty[' . $post_id . ']" value="' . $currentExistingValue . '"></div>';
            default:
        }
    }

    /**
     * Update product quantity in bulk
     * @param $redirect_to
     * @param $action
     * @param $post_ids
     * @return string
     */
    public function qsm_woo_stock_bulk_action_handler($redirect_to, $action, $post_ids)
    {
        if ($action !== 'qsm_woo_stock_update') {
            return $redirect_to;
        }
        foreach ($post_ids as $post_id) {

            $bulkPostData = filter_input_array(INPUT_GET);
            $new_qsm_woo_qty = sanitize_text_field($bulkPostData['qsm_woo_qty'][$post_id]);
            update_post_meta($post_id, '_stock', $new_qsm_woo_qty);
        }

        $redirect_to = add_query_arg('qsm_woo_bulk_stock_posts', count($post_ids), $redirect_to);

        return $redirect_to;
    }

    public function qsm_woo_stock_bulk_action_admin_notice()
    {
        if (!empty($_REQUEST['qsm_woo_bulk_stock_posts'])) {
            $stock_count = intval(sanitize_text_field($_REQUEST['qsm_woo_bulk_stock_posts']));

            printf(
                '<div id="message" class="updated notice notice-success is-dismissible"><p>' .
                _n('%s Stock Updated Successfully.', '%s Stock Updated Successfully.', $stock_count, 'quick-stock-management')
                . '</p></div>',
                $stock_count
            );
        }
    }
}
