<?php

function follow_ajax_action() {
    global $current_user;

    $request = $_REQUEST;

    $current_user_id = $current_user->ID;

    $user_to_follow = get_user_by("ID", $request['streamer']);



    $following_users = get_user_meta($current_user_id, 'following_users', true);
    $followers = get_user_meta($user_to_follow->ID, 'followers', true);
    $own_followers =get_user_meta($current_user->ID, 'followers', true);


    if ($current_user_id === $user_to_follow->ID) {
        wp_send_json_success(array(
            'following_users' => $following_users ? count($following_users) : 0,
            'followers' => $own_followers ? count($own_followers) : 0,
            'own_stream'=> true,
        ));
        exit();
    }


    if ($request['text'] === 'Follow me') {

        if (!$following_users)
            $following_users = array();

        if (!in_array($user_to_follow->ID, $following_users)) {

            $following_users[] = $user_to_follow->ID;
        }

        if (!$followers)
            $followers = array();

        if (!in_array($current_user_id, $followers)) {

            $followers[] = $current_user_id;
        }
    } elseif ($request['text'] === 'Unfollow me') {

        $key1 = array_search($user_to_follow->ID, $following_users);

        if ($key1 !== false) {
            unset($following_users[$key1]);
        }

        $key2 = array_search($current_user_id, $followers);

        if ($key2 !== false) {
            unset($followers[$key2]);
        }
    }

    update_user_meta($current_user_id, 'following_users', array_values($following_users));
    update_user_meta($user_to_follow->ID, 'followers', array_values($followers));

    wp_send_json_success(array(
        'following_users' => $following_users ? count($following_users) : 0,
        'followers' => $own_followers ? count($own_followers) : 0,
        'own_stream'=> false,
    ));
    exit();
}
