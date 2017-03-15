<?php

class FollowManagment {

    public function __construct() {

        $this->define_actions();
    }

    function define_actions() {
        add_action('wp_enqueue_scripts', array($this, 'follow_managment'));
    }

    function follow_managment() {
        global $current_user;

        if ($current_user->ID !== 0) {
            $following_users = get_user_meta($current_user->ID, 'following_users', true);
            $followers = get_user_meta($current_user->ID, 'followers', true);

            wp_localize_script("uff-script", 'following_object', array(
                'following_users' => $following_users,
                'total_following' => $following_users? count($following_users): 0,
                'total_followers' => $followers? count($followers): 0,
                    )
            );
        } else{
            wp_localize_script("uff-script", 'following_object', array(
                'following_users' => "anonim",
                    )
            ); 
        }
    }

}
