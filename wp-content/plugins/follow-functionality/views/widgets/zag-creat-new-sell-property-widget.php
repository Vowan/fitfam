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
class Zag_Creat_New_Sell_Property_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Zag_Creat_New_Sell_Property_Widget', // Base ID
                __('Zag_Creat_New_Sell_Property_Widget', 'text_domain'), // Name
                array('description' => __('Zag_Creat_New_Sell_Property_Widget!', 'text_domain'),) // Args
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
        ?>

        <div class="container-fluid">

            <form id="new-sell-property-form">

                <input type="hidden" name="street_number"  id="street_number"/>
                <input type="hidden" name="route" id="route" />
                <input type="hidden" name="locality" id="locality" />	
                <input type="hidden" name="sublocality_level_1" id="sublocality_level_1" />	
                <input type="hidden" name="country" id="country" />	
                <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1" />


                <input type="hidden" name="latitude" id="latitude" />	
                <input type="hidden" name="longitude" id="longitude" />

                <input type="hidden" name="type" value="sell" > 

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align: center;">Продать</div>
                        </div>
                    </div>
                </div> <!-- Kind of prop -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align: center;">
                                <input id="autocomplete" placeholder="набирайте населенный пункт, номер дома, улица" class="form-control"
                                       onFocus="" type="text"></input>
                            </div>
                            <div class="panel-body">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- map -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">

                            <div class="panel-heading" style="text-align: center;">Итоговый адрес </div>

                            <div class="panel-body">
                                <address id="prop_address"> </address>
                            </div>
                        </div>
                    </div>
                </div> <!-- final address -->



                <div class="row">

                    <div class="col-sm-6">

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

                                        <div class="col-xs-5">
                                            <label >Скайп</label>
                                            <div class="input-group">

                                                <input type="text" 
                                                       name="skype" 
                                                       id="skype" 
                                                       class="form-control" 
                                                       value="<?= get_user_meta($current_user->ID, "skype")[0] ?>" />
                                            </div>
                                        </div> 

                                        <div class="col-xs-7">
                                            <label >Вайбер</label>
                                            <div class="input-group">

                                                <input type="text" 
                                                       name="viber" 
                                                       id="viber" 
                                                       class="form-control" 
                                                       value="<?= get_user_meta($current_user->ID, "viber")[0] ?>" />	
                                            </div>

                                        </div> 
                                    </div> 

                                    <div class="row">

                                        <div class="col-xs-12">
                                            <label >cтатус</label>
                                            <div class="input-group">
                                                <select name="user_agency" class="form-control">
                                                    <?php if (get_user_meta($current_user->ID, "user_agency")[0]): ?>
                                                        <option value="agency"><?= get_user_meta($current_user->ID, "user_agency")[0] ?></option>
                                                    <?php else: ?>
                                                        <option value="хозяин">хозяин</option>
                                                        <option value="риэлтор">риэлтор</option>

                                                    <?php endif; ?>
                                                </select>

	
                                            </div>
                                        </div> 


                                    </div> 


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Общие параметры</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="row">

                                        <div class="col-xs-6">
                                            <label>цена в $</label><br>
                                            <div class="input-group">
                                                <input type="number"
                                                       name="cost_US" 
                                                       id="cost_US" 
                                                       class="form-control"
                                                       min="1"
                                                       placeholder="цена" />	
                                                <span class="input-group-addon">.000</span>
                                            </div> 
                                            <label id="priceDolError" style="color:red;" ></label>
                                        </div> 

                                        <div class="col-xs-6">
                                            <label>цена в грн</label><br>
                                            <div class="input-group">
                                                <input type="number" 
                                                       name="cost_GRN" 
                                                       id="cost_GRN" 
                                                       class="form-control" 
                                                       placeholder="цена" />	
                                                <span class="input-group-addon">.000</span>
                                            </div> 
                                        </div> 
                                    </div> 

                                    <div class="row">

                                        <div class="col-xs-6">
                                            <label>количество комнат</label><br>
                                            <div class="input-group">
                                                <input type="number" 
                                                       name="rooms" 
                                                       id="rooms" 
                                                       class="form-control"
                                                       placeholder="к-во комнат" min="1" max="10"  value="1"/>	
                                                <span class="input-group-addon">комнат</span>

                                            </div>
                                            <label id="roomNError" style="color:red;" ></label>
                                        </div> 

                                        <div class="col-xs-6">
                                            <label>этажность</label><br/>

                                            <div class="input-group">

                                                <input type="text"
                                                       name="level" 
                                                       id="level" class="form-control" placeholder="этаж - этаж" />	
                                                <span class="input-group-addon">эт-эт</span>

                                            </div>

                                        </div> 
                                    </div> 

                                    <div class="row">

                                        <div class="col-xs-6">
                                            <label>общая площадь</label><br>
                                            <div class="input-group">

                                                <input type="number" 
                                                       name="totalSQ" 
                                                       id="totalSQ" class="form-control" placeholder="общая " />	
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div> 
                                        <div class="col-xs-6">
                                            <label>жилая площадь</label><br>
                                            <div class="input-group">

                                                <input type="number" name="liveSQ" 
                                                       id="liveSQ" class="form-control" placeholder="жилая " />	
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>

                                        <div class="col-xs-6">
                                            <label>состояние</label><br>
                                            <div class="input-group">

                                                <select name="state" class="form-control">
                                                    <option value="от строителей">от строителей</option>
                                                    <option value="жилое">жилое</option>
                                                    <option value="евроремонт">евроремонт</option>
                                                    <option value="под ремонт">под ремонт</option>
                                                </select>

                                            </div> 
                                        </div>


                                    </div> 


                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- user and main -->


                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Титульное сообщение</div>
                            <div class="panel-body">
                                <div class="input-group" style="width: 100%;">

                                    <input type="text" name="shot_title" id="shot_title" class="form-control" placeholder="3-х конатная квартира" />	

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!--Title panel -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align: center;">Краткое описание:</div>

                            <div class="panel-body">
                                <textarea 
                                    class="form-control" 
                                    rows="5" 
                                    name="comment" 
                                    placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </div> <!--message -->

                <div class="row">

                    <div class="col-sm-6">
                        <section id="all-rooms">

                            <div id="room-0" class="panel panel-default zag-project" >
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <select name="select[0]" class="form-control">
                                                <option value="санузел">санузел</option>

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
                                                <option value="кухня">кухня</option>

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
                            <button id="sellRoomButton" type="button" class="btn btn-primary">Добавить  комнату</button>


                        </section>

                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
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
                        </div>
                    </div>
                </div> <!-- rooms and slider -->


                <div id="row_error"  class="row" style="display: none;">
                    <div class="col-sm-12">
                        <div class="panel panel-default">

                            <div class="panel-heading" style="text-align: center;">Ошибки заполнения</div>

                            <div id="body_error" class="panel-body">

                            </div>
                        </div>
                    </div>
                </div> <!-- errors -->


                <?php
                wp_nonce_field('ajax-zag-registration-nonce', 'zag-registration');
                ?>
                <div  class="row" >
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div  class="panel-body">
                                <button id="zag-new-sell-prop" type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div> 

            </form>

        </div>

        <!------------------------------------------------------------------------------------------------>

        <div id="room-draft" class="panel panel-default zag-project" style="display: none; ">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <select name="select[-]" class="form-control">
                            <option value="столовая">столовая</option>
                            <option value="гостинная">гостинная</option>
                            <option value="спальня">спальня</option>

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
