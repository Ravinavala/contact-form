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

/* The core plugin class that is used to define internationalization, */
require CUSTOM_FORM_INCLUDE_PATH . 'includes/class-custom-form.php';

$admin = new Custom_Form_Admin();