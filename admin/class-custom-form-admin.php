<?php

class Custom_Form_Admin {

    /**
     * The ID of this plugin.
     *
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'customform_admin_menu'));
    }

    public function customform_admin_menu() {
        add_menu_page('Custom Contact Form', 'Custom form settings', 'manage_options', 'custom_form_settings', array(
            $this,
            'custom_form_content',
        ));
    }

    public function custom_form_content() {
        require CUSTOM_FORM_ADMIN_HTML_PATH . 'custom-form-admin-page.php';
    }
}
