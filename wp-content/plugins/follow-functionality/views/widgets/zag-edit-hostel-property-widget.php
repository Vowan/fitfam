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
class Zag_Edit_Hostel_Property_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Zag_Edit_Hostel_Property_Widget', // Base ID
                __('Zag_Edit_Hostel_Property_Widget', 'text_domain'), // Name
                array('description' => __('Zag_Edit_Hostel_Property_Widget!', 'text_domain'),) // Args
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

                <div class="col-sm-6">



                    <input id="autocomplete" placeholder="Enter your address" class="form-control"
                           onFocus="geolocate()" type="text"></input>



                    <div id="map"></div>
                    <br>

                    <div id="prop-slider" class="carousel slide" >
                        <!-- Indicators -->
                        <ol class="carousel-indicators"></ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox"></div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#prop-slider" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#prop-slider" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
                <div class="col-sm-6">

                    <div id="profile-errors" class="row"> </div>

                    <div  class="row">  <label>Адрес</label><address id="prop_address"> </address> </div>


                    <form id="new-property-form">

                        <input type="hidden" name="street_number"  id="street_number"/>
                        <input type="hidden" name="route" id="route" />
                        <input type="hidden" name="locality" id="locality" />	
                        <input type="hidden" name="sublocality_level_1" id="sublocality_level_1" />	
                        <input type="hidden" name="country" id="country" />	
                        <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1" />	

                        <div class="form-group">
                            <div class="row">
                                <div class="input-group">
                                    <label >Имя контактного лица</label>
                                    <input type="text" 
                                           name="user_first_name" 
                                           id="shot_title" 
                                           class="form-control" 
                                           value="<?= get_user_meta($current_user->ID, "user_first_name")[0] ?>" />	
                                </div>  
                                <div class="input-group">
                                    <label >Фамилия контактного лица</label>
                                    <input type="text" 
                                           name="user_last_name" 
                                           id="shot_title" 
                                           class="form-control" 
                                           value="<?= get_user_meta($current_user->ID, "user_last_name")[0] ?>" />
                                </div>
                                <div class="input-group">
                                    <label >Телефон</label>
                                    <input type="number" 
                                           name="user_tel" 
                                           id="shot_title" 
                                           class="form-control" 
                                           value="<?= get_user_meta($current_user->ID, "user_tel")[0] ?>" />	
                                </div>
                                <div class="input-group">
                                    <label >Email</label>
                                    <input type="email" 
                                           name="user_email" 
                                           id="shot_title" 
                                           class="form-control" 
                                           value="<?= get_user_meta($current_user->ID, "user_email")[0] ?>" />	
                                </div>
                                <div class="input-group">
                                    <label >Агенство</label>
                                    <input type="text" 
                                           name="user_agency" 
                                           id="shot_title" 
                                           class="form-control" 
                                           value="<?= get_user_meta($current_user->ID, "user_agency")[0] ?>" />	
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="input-group">
                                    <label >Титульное сообщение</label>
                                    <input type="text" name="shot_title" id="shot_title" class="form-control" placeholder="3-х конатная квартира" />	


                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="input-group">
                                    <label >Вид операции с недвижимостью</label><br>
                                    <input type="radio" name="type" value="sell" checked> Продать 
                                    &nbsp;<input type="radio" name="type" value="buy" > Купить
                                    &nbsp; <input type="radio" name="type" value="project">Новострой<br>

                                    <input type="radio" name="type" value="rent_short">Сдать посуточно
                                    &nbsp; <input type="radio" name="type" value="rent_long">Сдать длительно<br>
                                    <input type="radio" name="type" value="rent_rever"> Снять
                                    &nbsp; <input type="radio" name="type" value="hostel"> Хостел<br>




                                </div>
                            </div>

                        </div>

                        <section id="form_sell">

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-xs-6">

                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="number" name="property_price" id="property_price" class="form-control" placeholder="цена" />	
                                            <span class="input-group-addon">.000</span>
                                        </div> 
                                    </div> 

                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">грн.</span>
                                            <input type="number" name="property_price_gry" id="property_price" class="form-control" placeholder="цена" />	
                                            <span class="input-group-addon">.000</span>
                                        </div> 
                                    </div> 
                                </div> 
                            </div> 


                            <div class="form-group">
                                <div class="row">

                                    <div class="col-xs-6">

                                        <div class="input-group">
                                            <span class="input-group-addon">N</span>
                                            <input type="number" name="property_roomN" id="property_roomN" class="form-control" placeholder="к-во комнат" min="1" max="10"  value="1"/>	
                                            <span class="input-group-addon">комнат</span>

                                        </div>
                                    </div> 

                                    <div class="col-xs-6">

                                        <div class="input-group">
                                            <span class="input-group-addon">N</span>
                                            <input type="text" name="house_level" id="property_roomN" class="form-control" placeholder="этаж/этажность" />	
                                            <span class="input-group-addon">эт/эт</span>

                                        </div>

                                    </div> 
                                </div> 
                            </div> 

                            <div class="form-group">

                                <div class="row">

                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Общая</span>
                                            <input type="number" name="total_sq" id="property_price" class="form-control" placeholder="общая " />	
                                            <span class="input-group-addon">m2</span>
                                        </div> 
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Жилая</span>
                                            <input type="number" name="life_sq" id="property_price" class="form-control" placeholder="жилая " />	
                                            <span class="input-group-addon">m2</span>
                                        </div> 
                                    </div>



                                </div>
                            </div>

                            <div class="form-group">

                                <div class="row">
                                    <label for="comment">Краткое описание:</label>
                                    <textarea class="form-control" rows="5" name="comment" placeholder=""></textarea>
                                </div>

                            </div>

                            <div id="room_add">

                                <!-- 0  -->

                                <div id="id[0]" class="form-group"> 
                                    <div  class="row">   

                                        <div class="col-xs-4">
                                            <div class="input-group">
                                                <select name="select[0]" class="form-control">
                                                    <option value="bath">санузел/ванная</option>

                                                </select> 	
                                            </div> 
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="input-group">

                                                <input type="number" name="room_sq[0]"  class="form-control" placeholder=" m2" />	
                                                <span class="input-group-addon">m2</span>

                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="input-group">

                                                <input type="number" name="bath_quantity" id="bath_quantity" class="form-control" placeholder="к-во" min="1" max="3"  value="1"/>	
                                                <span class="input-group-addon">к-во</span>

                                            </div>
                                        </div>


                                    </div>

                                    <div  class="row">

                                        <div class="col-xs-4">
                                            <div class="input-group">


                                                <label class="btn btn-default btn-file">
                                                    Загрузить фото <input type="file" style="display: none;" 
                                                                          name="room_file[0]"  class="form-control"  multiple>
                                                </label>

                                            </div>
                                        </div>

                                        <div class="col-xs-8">
                                            <div id="preview0"  class="input-group"></div>
                                        </div>

                                    </div>

                                </div>

                                <!-- 1 -->

                                <div id="id[1]" class="form-group"> 
                                    <div  class="row">   

                                        <div class="col-xs-6">
                                            <div class="input-group">
                                                <select name="select[1]" class="form-control">
                                                    <option value="kitchen">кухня</option>

                                                </select> 	
                                            </div> 
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="input-group">

                                                <input type="number" name="room_sq[1]"  class="form-control" placeholder=" m2" />	
                                                <span class="input-group-addon">m2</span>

                                            </div>
                                        </div>
                                    </div>

                                    <div  class="row">

                                        <div class="col-xs-4">
                                            <div class="input-group">


                                                <label class="btn btn-default btn-file">
                                                    Загрузить фото <input type="file" style="display: none;" 
                                                                          name="room_file[1]"  class="form-control"  multiple>
                                                </label>

                                            </div>
                                        </div>

                                        <div class="col-xs-8">
                                            <div id="preview1"  class="input-group"></div>
                                        </div>

                                    </div>

                                </div>

                                <!-- 2-->

                                <div id="id[2]" class="form-group room"> 
                                    <div  class="row">   

                                        <div class="col-xs-6">
                                            <div class="input-group">
                                                <select name="select[2]" class="form-control">
                                                    <option value="dining">столовая</option>
                                                    <option value="sitting">гостинная</option>
                                                    <option value="bedroom">спальня</option>
                                                </select> 	
                                            </div> 
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="input-group">

                                                <input type="number" name="room_sq[2]"  class="form-control" placeholder=" m2" />	
                                                <span class="input-group-addon">m2</span>

                                            </div>
                                        </div>
                                    </div>

                                    <div  class="row">

                                        <div class="col-xs-4">
                                            <div class="input-group">


                                                <label class="btn btn-default btn-file">
                                                    Загрузить фото <input type="file" style="display: none;" 
                                                                          name="room_file[2]"  class="form-control"  multiple>
                                                </label>

                                            </div>
                                        </div>

                                        <div class="col-xs-8">
                                            <div id="preview2"  class="input-group"></div>
                                        </div>

                                    </div>

                                </div>



                            </div>
                        </section>
                        
                        <section id="form_buy">
                            
                        </section>



                        <input type="hidden" name="latitude" id="latitude" />	
                        <input type="hidden" name="longitude" id="longitude" />	




                        <?php
                        wp_nonce_field('ajax-zag-registration-nonce', 'zag-registration');

                        /*
                         * wp-includes/functions.php
                         * 'ajax-zag-registration-nonce' - action name
                         *  'zag-registration' - id of <input> tag
                         * 
                         */
                        ?>
                        <br>
                        <button id="zag-new-prop" type="button" class="btn btn-primary">Submit</button>

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
