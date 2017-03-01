<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

session_start();
add_action( 'after_setup_theme', 'custom_login' );
add_action( 'wp_login_failed', 'pu_login_failed' ); // hook failed login

if ($_GET['log'] == 'facebook')
{
    wp_redirect(get_site_url());
    exit();
}


global $user;

if (is_user_logged_in() && $_GET['login'] == 'failed')
    header("Location: ".get_site_url());



function pu_login_failed( $user ) {
    // check what page the login attempt is coming from
    $referrer = $_SERVER['HTTP_REFERER'];

    // check that were not on the default login page
    if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $user!=null ) {
        // make sure we don't already have a failed login attempt
        if ( !strstr($referrer, '?login=failed' )) {
            // Redirect to the login page and append a querystring of login failed
            wp_redirect( $referrer . '?login=failed');
        } else {
            wp_redirect( $referrer );
        }
        exit;
    }
}

function custom_login() {

    if(!is_user_logged_in())
    {
        if ($_SESSION['user'] && $_SESSION['facebook_access_token'] && username_exists($_SESSION['user_email']))
        {
            $pwd = substr($_SESSION['facebook_access_token'], 0,15);
            $user_id = username_exists ($_SESSION['user_email']);
            wp_set_password ( $pwd, $user_id);

            $arr = array ();

            $arr['user_login'] = $_SESSION['user_email'];
            $arr['user_password'] = $pwd;
            $arr['remember'] = true;

            $user = wp_signon($arr, false);

            unset($_SESSION["user_email"]);
            unset($_SESSION['user']);
            unset($_SESSION['facebook_access_token']);
            session_destroy();

            if (is_wp_error($user))
                wp_redirect (get_site_url().'?login=failed');

            wp_redirect(get_site_url());
            exit ();
        }

    }

}

function register_user ()
{
    if ($_POST['reg_name'])
        $reg_name = $_POST['reg_name'];
    if ($_SESSION['user_email'])
        $reg_name = $_SESSION['user_email'];

    if ($reg_name != '')
    {
        $user_id = username_exists( $reg_name );

        if (!$user_id && !$_SESSION['user'])
            if (!$user_id)
            {
                if ($_SESSION['user'])
                {
                    $data_user = json_decode($_SESSION['user']);
                    $data_user = $data_user->response[0];
                    $first_name = $data_user->first_name;
                    $last_name = $data_user->last_name;

                    $pass = substr($_SESSION['user_token'], 0,15);
                    if ($_SESSION['user_email'])
                        $user_email = $_SESSION['user_email'];
                    else
                        $user_email = $_POST['reg_email'];
                }
                else
                {
                    $pass = $_POST['reg_pass'];
                    $first_name = $_POST['first_reg_name'];
                    $last_name = $_POST['last_reg_name'];
                    $user_email = $_POST['reg_email'];
                }

                if (!$user_email)
                    $user_email = $reg_name;

                $user_id = wp_create_user($reg_name, $pass, $user_email);
                update_user_meta( $user_id, 'first_name', $first_name );
                update_user_meta( $user_id, 'last_name',  $last_name);

                $message = 'You have successfully register on fitfam';

                wp_mail($user_email, get_option('blogname'), $message);

                wp_redirect(get_site_url());
        }
            else echo 'user with the same name already exists!';
    }
}