<?php
/*
  Plugin Name: Zag Loginout Widget
 */

// Block direct requests
if (!defined('ABSPATH'))
    die('-1');

/**
 * Adds My_Widget widget.
 */
class My_Loginout_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'My_Loginout_Widget', // Base ID
                __('My_Loginout_Widget', 'text_domain'), // Name
                array('description' => __('My Loginout widget!', 'text_domain'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {

        $current_user = wp_get_current_user();

        if (is_user_logged_in()) {

            $login = 'hidden';
            $logout = 'show';
        } else {
            $login = 'show';
            $logout = 'hidden';
        }
        ?>
        <ul  class="nav navbar-nav navbar-right <?= $login ?>" style="font-size: 1.5em;">
            <li><a id="user_login"  href="">Войти</a> </li>
            <li><a id="user_reg"  href="">Зарегистрироваться</a> </li>
            <li><a  id="user_avatar" class="user_avatar" href=""> <i class="glyphicon glyphicon-user"></i></a></li>

        </ul>


        <ul id="user_loginout" class="nav navbar-nav navbar-right <?= $logout ?>" style="font-size: 1.5em;">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" 
                   data-toggle="dropdown" 
                   role="button" 
                   aria-haspopup="true"
                   aria-expanded="false">+ Добавить<span class="caret"></span></a>
                <ul id="zero_prop" class="dropdown-menu">
                    <li><a data-id="<?= site_url() ?>/index.php/properties/zero?prop_type=sell" href="#">Продам</a></li>
                    <li><a data-id="<?= site_url() ?>/index.php/properties/zero?prop_type=buy" href="#">Куплю</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a data-id="<?= site_url() ?>/index.php/properties/zero?prop_type=project"  href="#">Новострой</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a data-id="<?= site_url() ?>/index.php/properties/zero?prop_type=rent_long" href="#">Длительная аренда</a></li>
                    <li><a data-id="<?= site_url() ?>/index.php/properties/zero?prop_type=rent_rever" href="#">Сниму</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a data-id="<?= site_url() ?>/index.php/properties/zero?prop_type=rent_short" href="#">Посуточная аренда</a></li>
                    <li><a data-id="<?= site_url() ?>/index.php/properties/zero?prop_type=hostel" href="#">Хостел</a></li>

                </ul>
            </li>
<!--
            <li>
                <a id="zero_prop"  data-id="<?= site_url() ?>/index.php/properties/zero" href="">+ Добавить
                </a> 
            </li>-->

            <li><a  id="user_photo" class="user_avatar"  href=""> <img src="<?= $meta = get_user_meta($current_user->ID, "photo")[0] ?> " 
                                                                       style="width: 46px; height: 46px;" /></a></li>
            <li><a id="user_logout" href="">Выйти</a> </li>

        </ul>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}
