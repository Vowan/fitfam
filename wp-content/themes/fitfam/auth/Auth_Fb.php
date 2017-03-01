<?php

class response
{
    public $first_name;
    public $last_name;
}

class user_data
{
    public $response = array();

    public  function __construct ()
    {
        $response[] = new response();
    }

}
    class Auth_Fb
    {
        private $token;
        private $uid;
        private $email;
        private $code;
        private $fb;
        public $loginUrl;

        public function __construct ()
        {
            require "configuration.php";
            require_once 'facebook-php-sdk-v5/src/Facebook/autoload.php';

            $this->fb = new Facebook\Facebook([
                'app_id' => ClIENT_ID,
                'app_secret' => ClIENT_SECRET
            ]);
            ini_set('display_errors', 'Off'); // теперь сообщений НЕ будет
        }
        
        public function set_code ($code)
        {
            $this->code = $code;
        }

        public function set_token ($token)
        {
            $this->token = $token;
        }

        public function set_uid ($uid)
        {
            $this->uid = $uid;
        }

        public function set_email ($email)
        {
            $this->email=$email;
        }

        public function redirect_url ($url)
        {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$url);
            exit ();
        }

        public function set_loginUrl($url)
        {
            $this->loginUrl = $url;
        }

        public function get_loginUrl()
        {
            $helper = $this->fb->getRedirectLoginHelper();
            $permissions = ['email', 'user_likes', 'public_profile']; // optional
            $loginUrl = $helper->getLoginUrl(REDIRECT_URL_FB, $permissions);

            $this->set_loginUrl($loginUrl);
        }

        public function get_token ()
        {
            $helper = $this->fb->getRedirectLoginHelper();

            
            try {
                $accessToken = $helper->getAccessToken();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            if (isset($accessToken)) {
                $_SESSION['facebook_access_token'] = (string)$accessToken;
                try {
                    $response = $this->fb->get('/me?fields=id,name,email,first_name,last_name,work,birthday,website,about,education,link', $_SESSION['facebook_access_token']);
                } catch (Facebook\Exceptions\FacebookResponseException $e) {
                    echo 'Graph returned an error: ' . $e->getMessage();
                    exit;
                } catch (Facebook\Exceptions\FacebookSDKException $e) {
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                    exit;
                }
            }
            $user = $response->getGraphUser();
            $this->set_token($_SESSION['user_token']);
            $this->set_uid($user['id']);
            $this->set_email($user['email']);
            $this->get_user($user);
        }

        public function get_user ($user)
        {
//                ini_set('display_errors', 'On'); // сообщения с ошибками будут показываться
//                error_reporting(E_ALL); // E_ALL - отображаем ВСЕ ошибки
                $user_data = new user_data();

                $user_data->response[0]->first_name = $user['first_name'];
                $user_data->response[0]->last_name = $user['last_name'];

                $_SESSION['user'] = json_encode($user_data);
                $_SESSION['user_email'] = $this->email;

             $this->redirect_url('http://dap-it.pro/puplic/fitfam/?log=facebook');

        }


        public function get_link_share()
        {
            $query = 'app_id='.ClIENT_ID.'&redirect_uri='.$_SERVER['HTTP_REFERER'].'&display=page&href='.get_permalink();
            return 'https://www.facebook.com/dialog/share?'.$query;
        }

    }


