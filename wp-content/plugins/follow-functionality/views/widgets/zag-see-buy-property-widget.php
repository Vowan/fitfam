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
class Zag_See_Buy_Property_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Zag_See_Buy_Property_Widget', // Base ID
                __('Zag_See_Buy_Property_Widget', 'text_domain'), // Name
                array('description' => __('Zag_See_Buy_Property_Widget!', 'text_domain'),) // Args
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

        $current_post = sanitize_post($GLOBALS['wp_the_query']->get_queried_object());

        $address_data = get_post_meta($current_post->ID, "address_data_ru", true);
        $prop_type = get_post_meta($current_post->ID, "property_type", true);

        $user_data = get_post_meta($current_post->ID, "user_info", true);

        $main_data = get_post_meta($current_post->ID, 'main_data', true);
        
         $pfx_date = get_the_date('d/m/Y', $current_post->ID);

        ?>

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">

                    <div class="well panel-primary" style="text-align: center;"><h3>Куплю</h3>
                        <span class="label label-info" style="font-size: 110%;">дата публикации
                            <span class="badge" style="font-size: 110%;"><?= $pfx_date ?>
                            </span>
                        </span>
                    </div>
                </div>
            </div> <!--Title panel -->



             <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="text-align: center;"><h3><?= $main_data['shot_title'] ?></h3></div>
                        <div class="panel-body">
                            <div class="row" >
                                <div class="col-xs-4" style="text-align: center;">
                                    <span class="label label-warning" style="font-size: 110%;">цена в грн
                                        <span class="badge" style="font-size: 110%;"><?= $main_data['cost_GRN'] ?>000
                                        </span>
                                    </span>
                                </div>
                                <div class="col-xs-4" style="text-align: center;">
                                    <span class="label label-info" style="font-size: 110%;">количество комнат
                                        <span class="badge" style="font-size: 110%;"><?= $main_data['rooms'] ?>
                                        </span>
                                    </span>
                                </div>
                                <div class="col-xs-4" style="text-align: center;">
                                    <span class="label label-info" style="font-size: 110%;">общая площадь
                                        <span class="badge" style="font-size: 110%;"><?= $main_data['totalSQ'] ?>
                                        </span>
                                    </span>
                                </div> 
                            </div>
                            <br>
                            <div class="row" style="font-size: 110%;">
                                <div class="col-xs-4" style="text-align: center;">
                                    <span class="label label-info" style="font-size: 110%;">жилая площадь
                                        <span class="badge" style="font-size: 110%;"><?= $main_data['liveSQ'] ?>
                                        </span>
                                    </span>
                                </div>
                                <div class="col-xs-4" style="text-align: center;">
                                    <span class="label label-info" style="font-size: 110%;">этажность
                                        <span class="badge" style="font-size: 110%;"><?= $main_data['level'] ?>
                                        </span>
                                    </span>
                                </div>
                                <div class="col-xs-4" style="text-align: center; ">
                                    <span class="label label-info" style="font-size: 110%;">состояние
                                        <span class="badge" style="font-size: 110%;"><?= $main_data['state'] ?>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="map"></div>
                        </div>
                    </div>

                </div>
               

            </div> <!-- map -->

            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: center;">Адрес</div>
                        <div class="panel-body">

                            <address>
                                <strong><?= $address_data['sublocality_level_1'] ?></strong><br>
                                <?= $address_data['route'] ?>,&nbsp;<?= $address_data['street_number'] ?><br>
                                <?= $address_data['locality'] ?><br>

                            </address>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Контактное лицо</div>
                        <div class="panel-body">

                            <address>
                                <strong><?= $user_data['user_first_name'] ?>&nbsp;<?= $user_data['user_last_name'] ?></strong><br>
                                <?= $user_data['user_tel'] ?><br>
                                <?= $user_data['user_email'] ?><br>
                                <?= $user_data['skype'] ?><br>
                                <?= $user_data['viber'] ?><br>
                                <?= $user_data['user_agency'] ?><br>
                                
                            </address>


                        </div>
                    </div>
                </div>
            </div> <!-- final address -->


            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: center;">Краткое описание:</div>

                        <div class="panel-body"><?= $main_data['comment'] ?> </div>
                    </div>
                </div>
            </div> <!--message -->





        </div>


        <?php
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'text_domain');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
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
