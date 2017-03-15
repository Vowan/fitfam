<?php

if (!class_exists('UFF_Basic')) {

    /**
     * The core plugin class.
     * 
     */
    class UFF_Basic {

        private static $instance;

        public static function instance() {

            if (!isset(self::$instance) && !( self::$instance instanceof WP_User_Manager )) {

                self::$instance = new UFF_Basic;
            }

            return self::$instance;
        }

        public function __construct() {

            $this->includes();


            new ScriptLoader;
            new StyleLoader;
            new FollowManagment;
            new FollowAjaxAction;
        }

        function includes() {
            require_once( dirname(__FILE__) . '/ScriptLoader.php' );
            require_once( dirname(__FILE__) . '/StyleLoader.php' );
            require_once( dirname(__FILE__) . '/FollowManagment.php' );
            require_once( dirname(__FILE__) . '/FollowAjaxAction.php' );
        }

//        public function register_post_types() {
//            register_post_type('user_stream', array(
//                'labels' => array(
//                    'name' => __('Streams'),
//                    'singular_name' => __('Stream')
//                ),
//                'public' => true,
//                'has_archive' => true,
//                'rewrite' => array('slug' => 'streams'),
//                    )
//            );
//  
//        }
    }

}
