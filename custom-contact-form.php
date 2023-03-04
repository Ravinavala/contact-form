<?php
/*
  Plugin Name: Custom contact form
  Description: This is a plugins to create custom form shortcode, Add and display user data.
  Author: Ravina Vala
  Version: 1.0
  Text Domain: custom-form
 */

$CUSTOMFORM = '1.0.0';

if (!defined('CUSTOM_FORM_VERSION')) {
    define('CUSTOM_FORM_VERSION', 'inspyde-user-list');
}

if (!defined('CUSTOM_FORM_PLUGIN_URL')) {
    define('CUSTOM_FORM_PLUGIN_URL', plugin_dir_url(__FILE__));
}

if (!defined('CUSTOM_FORM_PLUGIN_PATH')) {
    define('CUSTOM_FORM_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

if (!defined('CUSTOM_FORM_PLUGIN_BASENAME')) {
    define('CUSTOM_FORM_PLUGIN_BASENAME', plugin_basename(__FILE__));
}

define('CUSTOM_FORM_INCLUDE_PATH', CUSTOM_FORM_PLUGIN_PATH);
// Define admin html folder Path
define('CUSTOM_FORM_ADMIN_HTML_PATH', CUSTOM_FORM_INCLUDE_PATH . 'admin/html/');


/** The code that runs during plugin activation (but not during updates). */
function create_custom_db_plugin_activate() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'custom_contact_form_table';

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        contact_no varchar(255) NOT NULL,
        comment text NOT NULL,
        country varchar(255) NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

/** The code that runs when plugin uninstall. */
function custom_form_plugin_uninstall() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_contact_form_table';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

register_activation_hook(__FILE__, 'create_custom_db_plugin_activate');
register_uninstall_hook(__FILE__, 'custom_form_plugin_uninstall');

/* The core plugin class that is used to define internationalization, */
require CUSTOM_FORM_INCLUDE_PATH . 'includes/class-custom-form.php';

$admin = new Custom_Form_Admin();
