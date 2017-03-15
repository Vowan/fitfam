<?php

class FollowAjaxAction {

    public function __construct() {

        $this->includes();
        $this->define_actions();
    }

    function includes() {
        require_once( dirname(dirname(__FILE__)) . '/ajax/follow-ajax-action.php' );
        require_once( dirname(dirname(__FILE__)) . '/ajax/followers-ajax-action.php' );
        require_once( dirname(dirname(__FILE__)) . '/ajax/followees-ajax-action.php' );
    }

    function define_actions() {
        add_action('wp_ajax_follow-ajax-action', 'follow_ajax_action');
        add_action('wp_ajax_followers-ajax-action', 'followers_ajax_action');
        add_action('wp_ajax_followees-ajax-action', 'followees_ajax_action');
    }

}
