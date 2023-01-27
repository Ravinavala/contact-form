<?php

class Custom_Form {

    protected $version;
    protected $customform;

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
    }

    /**     * Load the required dependencies for this plugin. */
    private function load_dependencies() {
        require_once CUSTOM_FORM_PLUGIN_PATH . 'admin/class-custom-form-admin.php';
    }

    public function print_script() {
        
    }

}

$Custom_Form = new Custom_Form();
