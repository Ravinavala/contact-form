<?php

class Custom_Form {
    /*     * * The current version of the plugin */

    protected $version;
    protected $customendpoint;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, and set the hooks for the admin area and the public-facing
     * side of the site.
     */
    public function __construct() {
        $this->load_dependencies();
        add_action('wp_enqueue_scripts', array($this, 'print_script'));
        add_action('admin_enqueue_scripts', array($this, 'cf_plugin_admin_styles'));
        add_shortcode('custom_contact_form', array($this, 'display_contact_form'));
    }

    /*     * * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin: */

    private function load_dependencies() {
        require_once CUSTOM_FORM_PLUGIN_PATH . 'admin/class-custom-form-admin.php';
    }

    public function print_script() {
        wp_enqueue_style('custom-form-css', CUSTOM_FORM_PLUGIN_URL . '/assets/css/form.css', 5645645, true);
        wp_enqueue_script(array('jquery'));
        wp_enqueue_script('jquery_validate', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array('jquery'), '20160412', true);
        wp_enqueue_script('jquery_validatation', 'https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js', array('jquery'), '20160412', true);
        wp_enqueue_script('customform-script', CUSTOM_FORM_PLUGIN_URL . '/assets/js/custom-form.js', array(), $this->version, true);
        wp_localize_script('customform-script', 'custom_form_ajax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('_wpnonce')
        ));
    }

    // Enqueue the CSS file for the plugin's admin pages
    function cf_plugin_admin_styles() {
        if ($_GET['page'] == "custom_form_settings") {
            wp_enqueue_style('my_plugin_admin_css', CUSTOM_FORM_PLUGIN_URL . '/assets/css/userdata.css');
        }
    }

    /** Add custom shortcode */
    function display_contact_form() {
        $output = '<form id="custom_contact_form" method="post" class="contact-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="contact_no">Contact Number:</label>
        <input type="tel" id="contact_no" name="contact_no" required>
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" required></textarea>
        <label for="country">Country:</label>
        <select id="country" name="country" required>
            <option value="" disabled selected>Select a country</option>
            <option value="US">United States</option>
            <option value="CA">Canada</option>
            <option value="MX">Mexico</option>
        </select>
        <input type="submit" value="Submit">
        <div id="message"></div>
        <div id="cfserr_msg"></div>
        <div id="cfs_msg"></div>
        </form>';
        return $output;
    }

}

$Custom_Form = new Custom_Form();
