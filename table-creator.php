<?php
defined('ABSPATH') or die('Access denied: Direct script access is not allowed.');

function custom_table_creator_create_table() {
    if (isset($_POST['create_table'])) {
        // Validate nonce
        check_admin_referer('custom_table_creator_action', 'custom_table_creator_nonce');

        global $wpdb;
        $table_name = $wpdb->prefix . sanitize_text_field($_POST['table_name']);
        $columns_number = intval($_POST['columns_number']);

        // Initialize an array to hold column definitions
        $column_definitions = [];

        for ($i = 0; $i < $columns_number; $i++) {
            // Assuming you have inputs like column_name_1, column_type_1, etc.
            $column_name = sanitize_text_field($_POST["column_name_$i"]);
            $column_type = sanitize_text_field($_POST["column_type_$i"]);
            $column_length = intval($_POST["column_length_$i"]);
            $is_primary = isset($_POST["column_primary_$i"]) ? "PRIMARY KEY" : "";
            $is_auto_increment = isset($_POST["column_auto_increment_$i"]) ? "AUTO_INCREMENT" : "";

            // Build the column definition string
            $column_def = "`$column_name` $column_type";
            if ($column_length) {
                $column_def .= "($column_length)";
            }
            if ($is_primary) {
                $column_def .= " $is_primary";
            }
            if ($is_auto_increment) {
                $column_def .= " $is_auto_increment";
            }

            // Add the column definition to the array
            $column_definitions[] = $column_def;
        }

        // Create the SQL query
        $sql = "CREATE TABLE $table_name (" . implode(', ', $column_definitions) . ");";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
