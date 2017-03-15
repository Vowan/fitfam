<?php

class ScriptLoader {

    public function __construct() {

        $this->define_actions();
    }

    function enqueue_scripts() {
        
        wp_enqueue_script('modal', plugin_dir_url(dirname(__FILE__)) . 'js/modal.js', array(), null, true);

        wp_enqueue_script('uff-script', plugin_dir_url(dirname(__FILE__)) . 'js/uff-script.js', array(), null, true);

        wp_localize_script("uff-script", 'ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce('ajax_nonce'),
                )
        );
    }

    function define_actions() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts')); // adding scripts
    }

}
