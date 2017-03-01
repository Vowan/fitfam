<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require "Auth_Fb.php";

$fb = new Auth_Fb();

if (!$_GET['code'])
{
    $fb->get_loginUrl();

    $fb->redirect_url($fb->loginUrl);
}
else if ($_GET['code']) {

    $fb->set_code($_GET['code']);

    $fb->get_token();
}



