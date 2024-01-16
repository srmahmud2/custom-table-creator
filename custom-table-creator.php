<?php
/**
 * Plugin Name:     Custom Table Creator
 * Description:     A plugin to create custom tables. Enjoy!
 * Plugin URI:      https://creativityoutside.com/plugins/custom-table-creator
 * Author:          Creatity Outside
 * Author URI:      https://creativityoutside.com
 * Version:           1.0.2
 * Requires at least: 3.5
 * Requires PHP: 5.6
 * Tested up to: 6.4.2
 * License:         GPL2
 * Text Domain:     custom-table-creator
 * Domain Path:     /languages
 */

defined('ABSPATH') or die('Access denied: Direct script access is not allowed.');

// Include other files
include_once plugin_dir_path(__FILE__) . 'admin-page.php';
include_once plugin_dir_path(__FILE__) . 'table-creator.php';
function custom_table_creator_enqueue_styles() {
    wp_enqueue_style('custom-table-creator-styles', plugin_dir_url(__FILE__) . 'custom-table-creator-styles.css');
}
add_action('admin_enqueue_scripts', 'custom_table_creator_enqueue_styles');


// Hook to add admin menu
add_action('admin_menu', 'custom_table_creator_menu');

function custom_table_creator_menu() {
    add_menu_page('Custom Table Creator', 'Table Creator', 'manage_options', 'custom-table-creator', 'custom_table_creator_admin_page');
}

// Hook to handle form submission
add_action('admin_init', 'custom_table_creator_create_table');
