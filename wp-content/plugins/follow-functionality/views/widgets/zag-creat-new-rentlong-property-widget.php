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
class Zag_Creat_New_RentLong_Property_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Zag_Creat_New_RentLong_Property_Widget', // Base ID
                __('Zag_Creat_New_RentLong_Property_Widget', 'text_domain'), // Name
                array('description' => __('Zag_Creat_New_RentLong_Property_Widget!', 'text_domain'),) // Args
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
                    <h2 style="margin: 0 auto;">Сдам на длительный срок
                    </h2>
                </div>
                <div class="col-sm-4"></div>
            </div>


            <div class="row">

                <div class="col-sm-6">

                    <input id="autocomplete" placeholder="Enter your address" class="form-control"
                           onFocus="geolocate()" type="text"></input>

                    <div id="map"></div>
                    <br>

                    <!--one room slider -->
                    <div id="one-room-slider" class="carousel slide" >
                        <!-- Indicators -->
                        <ol class="carousel-indicators"></ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox"></div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#one-room-slider" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#one-room-slider" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
                <div class="col-sm-6">

                    <div id="profile-errors" class="row"> </div>

                    <div  class="row">  <label>Адрес</label><address id="prop_address"> </address> </div>


                    <form id="new-longrent-form">

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
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="input-group">

                                                <input type="text" name="shot_title" id="shot_title" class="form-control" placeholder="3-х конатная квартира" />	

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!--Main panel -->

                        <div class="panel panel-default">
                            <div class="panel-heading">Основные характеристики</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="row">

                                        <div class="col-xs-5">
                                            <label >Стоимость в месяц в $</label>
                                            <div class="input-group">

                                                <input type="number" 
                                                       name="cost_US" 
                                                       id="cost_US" 
                                                       class="form-control" 
                                                       />
                                            </div>
                                        </div> 

                                        <div class="col-xs-7">
                                            <label >Стоимость в месяц в грн</label>
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

                        <section id="all-rooms">

                            <div id="room-0" class="panel panel-default zag-project" >
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <select name="select[0]" class="form-control">
                                                <option value="bath">санузел</option>

                                            </select>
                                        </div>
                                        <div class="col-xs-6">
                                            <button data-id="x" type="button" class="btn btn-danger pull-right">Удалить</button>
                                        </div>  
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label >площадь</label>
                                        <div class="input-group">

                                            <span class="input-group-addon">м2</span>
                                            <input 
                                                type="number" 
                                                name="roomSQ[0]" 
                                                id="roomSQ-0" 
                                                class="form-control" 
                                                min="1"/>
                                        </div>


                                        <div  class="row">

                                            <div class="col-xs-6">

                                                <label >Фото</label>
                                                <div class="input-group">


                                                    <label class="btn btn-default btn-file">
                                                        Загрузить <input type="file" style="display: none;" 
                                                                         name="room[0]"  class="form-control" multiple>
                                                    </label>

                                                </div>
                                            </div>

                                            <div class="col-xs-6">
                                                <div data-prev="x" id="prev-0"  class="input-group preview"></div>
                                            </div>

                                        </div>


                                    </div> 
                                </div>



                            </div>

                            <div id="room-1" class="panel panel-default zag-project" >
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <select name="select[1]" class="form-control">
                                                <option value="kitchen">кухня</option>

                                            </select>
                                        </div>
                                        <div class="col-xs-6">
                                            <button data-id="x" type="button" class="btn btn-danger pull-right">Удалить</button>
                                        </div>  
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">

                                        <label >площадь</label>
                                        <div class="input-group">

                                            <span class="input-group-addon">м2</span>
                                            <input 
                                                type="number" 
                                                name="roomSQ[1]" 
                                                id="roomSQ-1" 
                                                class="form-control" 
                                                min="1"/>
                                        </div>

                                        <div  class="row">

                                            <div class="col-xs-6">

                                                <label >Фото</label>
                                                <div class="input-group">


                                                    <label class="btn btn-default btn-file">
                                                        Загрузить <input type="file" style="display: none;" 
                                                                         name="room[1]"  class="form-control" multiple >
                                                    </label>

                                                </div>
                                            </div>

                                            <div class="col-xs-6">
                                                <div data-prev="x" id="prev-1"  class="input-group preview"></div>
                                            </div>

                                        </div>


                                    </div> 
                                </div>



                            </div>

                            <section id="sec-rooms">


                            </section>
                            <button id="rentlongRoomButton" type="button" class="btn btn-primary">Добавить  комнату</button>


                        </section>


                        <input type="hidden" name="latitude" id="latitude" />	
                        <input type="hidden" name="longitude" id="longitude" />	




                        <?php
                        wp_nonce_field('ajax-zag-registration-nonce', 'zag-registration');
                        ?>
                        <br>
                        <button id="zag-new-rentlong-prop" type="button" class="btn btn-primary">Submit</button>

                    </form>


                </div>

            </div>
        </div>

        <!------------------------------------------------------------------------------------------------>

        <div id="room-draft" class="panel panel-default zag-project" style="display: none; ">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <select name="select[-]" class="form-control">
                            <option value="dining">столовая</option>
                            <option value="sitting">гостинная</option>
                            <option value="bedroom">спальня</option>

                        </select>
                    </div>
                    <div class="col-xs-6">
                        <button data-id="x" type="button" class="btn btn-danger pull-right">Удалить</button>
                    </div>  
                </div>

            </div>
            <div class="panel-body">
                <div class="form-group">

                    <label >площадь</label>
                    <div class="input-group">

                        <span class="input-group-addon">м2</span>
                        <input 
                            type="number" 
                            name="roomSQ" 
                            id="roomSQ" 
                            class="form-control" 
                            min="1"/>
                    </div>

                    <div  class="row">

                        <div class="col-xs-6">

                            <label >Фото</label>
                            <div class="input-group">


                                <label class="btn btn-default btn-file">
                                    Загрузить <input type="file" style="display: none;" 
                                                     name="room[x]"  class="form-control" multiple>
                                </label>

                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div data-prev="x" id="prev-x"  class="input-group preview"></div>
                        </div>

                    </div>


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
