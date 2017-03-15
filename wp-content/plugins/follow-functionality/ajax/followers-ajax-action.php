<?php

function followers_ajax_action() {
    global $current_user;
    
    $request = $_REQUEST;
    $start = $request['start'];
    $length = $request['length'];

    $own_followers = get_user_meta($current_user->ID, 'followers', true);

    $range = array_slice($own_followers, $start, $length);

    foreach ($range as $key => $value) {

        $follower = get_user_by("ID", $value);
        $output[$key]['user_nicename'] = $follower->user_nicename;
        $output[$key]['user_email'] = $follower->user_email;
    }

    wp_send_json_success(array(
        'followers' => $output ? $output : "",
    ));
    exit();
}
