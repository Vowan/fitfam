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
class Zag_Creat_New_Rent_Rever_Property_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Zag_Creat_New_Rent_Rever_Property_Widget', // Base ID
                __('Zag_Creat_New_Rent_Rever_Property_Widget', 'text_domain'), // Name
                array('description' => __('Zag_Creat_New_Rent_Rever_Property_Widget!', 'text_domain'),) // Args
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

        global $current_user;

        if (is_user_logged_in()) {
            
        }
        ?>

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <h2 style="margin: 0 auto;">Сниму
                    </h2>
                </div>
                <div class="col-sm-4"></div>
            </div>


            <div class="row">

                <div class="col-sm-12">

                    <input id="autocomplete" placeholder="Enter your address" class="form-control"
                           onFocus="geolocate()" type="text"></input>

                    <div id="map"></div>


                </div>
            </div>
            <div class="row">

                <div class="col-sm-12">

                    <div id="profile-errors" class="row"> </div>

                    <div  class="row">  <label>Адрес</label><address id="prop_address"> </address> </div>


                    <form id="new-rentrever-form">

                        <input type="hidden" name="street_number"  id="street_number"/>
                        <input type="hidden" name="route" id="route" />
                        <input type="hidden" name="locality" id="locality" />	
                        <input type="hidden" name="sublocality_level_1" id="sublocality_level_1" />	
                        <input type="hidden" name="country" id="country" />	
                        <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1" />

                        <!--User panel -->

                        <div class="panel panel-default">
                            <div class="panel-heading">Контактное лицо</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="row">

                                        <div class="col-xs-5">
                                            <label >Имя (обязательно)</label>
                                            <div class="input-group">

                                                <input type="text" 
                                                       name="user_first_name" 
                                                       id="user_first_name" 
                                                       class="form-control" 
                                                       value="<?= get_user_meta($current_user->ID, "user_first_name")[0] ?>" />
                                            </div>
                                        </div> 

                                        <div class="col-xs-7">
                                            <label >Фамилия </label>
                                            <div class="input-group">

                                                <input type="text" 
                                                       name="user_last_name" 
                                                       id="user_last_name" 
                                                       class="form-control" 
                                                       value="<?= get_user_meta($current_user->ID, "user_last_name")[0] ?>" />
                                            </div>

                                        </div> 
                                    </div> 

                                    <div class="row">

                                        <div class="col-xs-5">
                                            <label >Телефон</label>
                                            <div class="input-group">

                                                <input type="number" 
                                                       name="user_tel" 
                                                       id="user_tel" 
                                                       class="form-control" 
                                                       value="<?= get_user_meta($current_user->ID, "user_tel")[0] ?>" />
                                            </div>
                                        </div> 

                                        <div class="col-xs-7">
                                            <label >Email</label>
                                            <div class="input-group">

                                                <input type="email" 
                                                       name="user_email" 
                                                       id="user_email" 
                                                       class="form-control" 
                                                       value="<?= get_user_meta($current_user->ID, "user_email")[0] ?>" />	
                                            </div>

                                        </div> 
                                    </div> 

                                    <div class="row">

                                        <div class="col-xs-12">
                                            <label >Агенство</label>
                                            <div class="input-group">
                                                <input type="text" 
                                                       name="user_agency" 
                                                       id="user_agency" 
                                                       class="form-control" 
                                                       value="<?= get_user_meta($current_user->ID, "user_agency")[0] ?>" />	
                                            </div>
                                        </div> 


                                    </div> 


                                </div>
                            </div>
                        </div>

                        <!--Title panel -->

                        <div class="panel panel-default">
                            <div class="panel-heading">Титульное сообщение</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="input-group"  style="width: 100%;">

                                        <input type="text" name="shot_title" id="shot_title" class="form-control"  style="width: 100%;" placeholder="Сниму" />	

                                    </div>


                                </div>
                            </div>
                        </div>

                        <!--Main panel -->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label><input type="radio" name="time_period" id="daily" value="посуточно" checked>Посуточно</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <label><input type="radio" name="time_period" id="long" value="долгосрочно">Долгосрочно</label>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="row">

                                        <div class="col-xs-6">
                                            <label >С (дата)</label>
                                            <div class="input-group">

                                                <input  
                                                    name="date_from" 
                                                    id="date_from" 
                                                    class="form-control datepicker" 
                                                    />
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <label >По (дата)</label>
                                            <div class="input-group">

                                                <input 
                                                    name="date_to" 
                                                    id="date_to" 
                                                    class="form-control datepicker" 
                                                    />
                                            </div>
                                        </div>

                                    </div>

                                    <div id="time" class="row">

                                        <div class="col-xs-5">
                                            <label >$ в <span data-id="time_int">месяц</span></label>
                                            <div class="input-group">

                                                <input type="number" 
                                                       name="cost_US" 
                                                       id="cost_US" 
                                                       class="form-control" 
                                                       />
                                            </div>
                                        </div> 

                                        <div class="col-xs-7">
                                            <label >грн в <span data-id="time_int">месяц</span></label>
                                            <div class="input-group">

                                                <input type="number" 
                                                       name="cost_GRN" 
                                                       id="cost_GRN" 
                                                       class="form-control" 
                                                       />
                                            </div>

                                        </div> 
                                    </div> 

                                    <div class="row">

                                        <div class="col-xs-6">
                                            <label >Общая площадь</label>
                                            <div class="input-group">

                                                <span class="input-group-addon">м2</span>
                                                <input 
                                                    type="number" 
                                                    name="totalSQ" 
                                                    id="totalSQ" 
                                                    class="form-control" 
                                                    min="1"/>
                                            </div>
                                        </div> 

                                        <div class="col-xs-6">
                                            <label >Жилая площадь</label>
                                            <div class="input-group">

                                                <span class="input-group-addon">м2</span>
                                                <input 
                                                    type="number" 
                                                    name="liveSQ" 
                                                    id="liveSQ" 
                                                    class="form-control" 
                                                    min="1"/>
                                            </div>

                                        </div>  
                                    </div> 

                                    <div class="row">


                                        <div class="col-xs-6">
                                            <label >Количество комнат</label>
                                            <div class="input-group">


                                                <input 
                                                    type="number" 
                                                    name="rooms" 
                                                    id="rooms" 
                                                    class="form-control" 
                                                    min="1"/>
                                            </div>
                                        </div> 

                                        <div class="col-xs-6">
                                            <label >Этаж/Этажность</label>
                                            <div class="input-group">

                                                <span class="input-group-addon">м2</span>
                                                <input 
                                                    type="text" 
                                                    name="level" 
                                                    id="level" 
                                                    class="form-control" 
                                                    />
                                            </div>

                                        </div>                                      


                                    </div> 
                                    <div class="row">
                                        <label for="comment">Краткое описание:</label>
                                        <textarea 
                                            class="form-control" 
                                            rows="5" 
                                            id="comment"
                                            name="comment" 
                                            ></textarea>
                                    </div>


                                </div>
                            </div>
                        </div>




                        <input type="hidden" name="latitude" id="latitude" />	
                        <input type="hidden" name="longitude" id="longitude" />	




                        <?php
                        wp_nonce_field('ajax-zag-registration-nonce', 'zag-registration');
                        ?>
                        <br>
                        <button id="zag-new-rentrever-prop" type="button" class="btn btn-primary">Submit</button>

                    </form>


                </div>

            </div>
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
