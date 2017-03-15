<?php

class StyleLoader {

    public function __construct() {

        $this->define_actions();
    }

    function enqueue_styles() {

       wp_enqueue_style('uff-styles', plugin_dir_url(dirname(__FILE__)) . 'css/uff-styles.css');
    }

    function define_actions() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    }

}

