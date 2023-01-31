<?php

class Custom_Form {

    protected $version;

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

        add_action('wp_ajax_contactform_data', array($this, 'contactform_data_callback'));
        add_action('wp_ajax_nopriv_contactform_data', array($this, 'contactform_data_callback'));
    }

    /** * Load the required dependencies for this plugin */

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

    /* Ajax call back function, to add user data in custom table */

    public function contactform_data_callback() {
        $output = "";
        if (!empty($_POST)) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'custom_contact_form_table';

            $wpdb->insert(
                    $table_name,
                    array(
                        'name' => wp_strip_all_tags($_POST['name']),
                        'email' => sanitize_email($_POST['email']),
                        'contact_no' => sanitize_text_field($_POST['contact_no']),
                        'comment' => sanitize_textarea_field($_POST['comment']),
                        'country' => sanitize_text_field($_POST['country'])
                    ),
                    array('%s', '%s', '%s', '%s', '%s')
            );

            $output = $wpdb->insert_id;
        } else {
            $output = 0;
        }
        echo $output;
        exit();
    }

}

$Custom_Form = new Custom_Form();