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
class Zag_Creat_New_Project_Property_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Zag_Creat_New_Project_Property_Widget', // Base ID
                __('Zag_Creat_New_Project_Property_Widget', 'text_domain'), // Name
                array('description' => __('Zag_Creat_New_Project_Property_Widget!', 'text_domain'),) // Args
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

            <form id="new-project-form">

                <input type="hidden" name="street_number"  id="street_number"/>
                <input type="hidden" name="route" id="route" />
                <input type="hidden" name="locality" id="locality" />	
                <input type="hidden" name="sublocality_level_1" id="sublocality_level_1" />	
                <input type="hidden" name="country" id="country" />	
                <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1" />

                <input type="hidden" name="latitude" id="latitude" />	
                <input type="hidden" name="longitude" id="longitude" />	

                <input type="hidden" name="type" value="project" > 

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align: center;">Новострой</div>
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

                    <div class="col-sm-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">Контактное лицо</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="row">

                                        <div class="col-xs-6">
                                            <label >Имя (обязательно)</label>
                                            <div class="input-group">

                                                <input type="text" 
                                                       name="user_first_name" 
                                                       id="user_first_name" 
                                                       class="form-control" 
                                                       value="<?= get_user_meta($current_user->ID, "user_first_name")[0] ?>" />
                                            </div>
                                        </div> 

                                        <div class="col-xs-6">
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

                                        <div class="col-sm-4">
                                            <label >Телефон</label>
                                            <div class="input-group">

                                                <input type="number" 
                                                       name="user_tel" 
                                                       id="user_tel" 
                                                       class="form-control" 
                                                       value="<?= get_user_meta($current_user->ID, "user_tel")[0] ?>" />
                                            </div>
                                        </div> 

                                        <div class="col-sm-4">
                                            <label >Email</label>
                                            <div class="input-group">

                                                <input type="email" 
                                                       name="user_email" 
                                                       id="user_email" 
                                                       class="form-control" 
                                                       value="<?= get_user_meta($current_user->ID, "user_email")[0] ?>" />	
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

                    <div class="col-sm-6">

                        <!--1-комнатные  квартиры -->
                        <div  class="panel panel-default">
                            <div class="panel-heading">1-комнатные  квартиры</div>

                            <section id="oneRoom">


                            </section>
                            <button id="oneRoomButton" type="button" class="btn btn-primary">Добавить однокомнатный проект</button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align: center;">Slider</div>

                            <div class="panel-body">
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
                        </div>

                    </div>



                </div>

                <div class="row">

                    <div class="col-sm-6">

                        <!--2-комнатные  квартиры -->
                        <div class="panel panel-default">
                            <div class="panel-heading">2-комнатные  квартиры</div>
                            <section id="twoRoom">


                            </section>
                            <button id="twoRoomButton" type="button" class="btn btn-primary">Добавить двухкомнатный проект</button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align: center;">Slider</div>

                            <div class="panel-body">
                                <!--two room slider -->
                                <div id="two-room-slider" class="carousel slide" >
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators"></ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox"></div>

                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#two-room-slider" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#two-room-slider" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>



                </div>

                <div class="row">

                    <div class="col-sm-6">

                        <!--3-комнатные  квартиры -->
                        <div class="panel panel-default">
                            <div class="panel-heading">3-комнатные  квартиры</div>
                            <section id="threeRoom">


                            </section>
                            <button id="threeRoomButton" type="button" class="btn btn-primary">Добавить трехкомнатный проект</button>
                        </div> 

                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align: center;">Slider</div>

                            <div class="panel-body">
                                <!--three room slider -->
                                <div id="three-room-slider" class="carousel slide" >
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators"></ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox"></div>

                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#three-room-slider" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#three-room-slider" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-6">

                        <!--4-комнатные  квартиры -->
                        <div class="panel panel-default">
                            <div class="panel-heading">4-комнатные  квартиры</div>
                            <section id="foreRoom">


                            </section>
                            <button id="foreRoomButton" type="button" class="btn btn-primary">Добавить четырехкомнатный проект</button>
                        </div> 
                    </div> 
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align: center;">Slider</div>

                            <div class="panel-body">
                                <!--four room slider -->
                                <div id="fore-room-slider" class="carousel slide" >
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators"></ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox"></div>

                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#fore-room-slider" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#fore-room-slider" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">

                    <div class="col-sm-6">

                        <!--пентхаузы -->

                        <div class="panel panel-default">
                            <div class="panel-heading">Пентхаузы</div>
                            <section id="pentRoom">


                            </section>
                            <button id="pentRoomButton" type="button" class="btn btn-primary">Добавить  проект пентхауза</button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align: center;">Slider</div>

                            <div class="panel-body">
                                <div id="pent-room-slider" class="carousel slide" >
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators"></ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox"></div>

                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#pent-room-slider" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#pent-room-slider" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <?php
                wp_nonce_field('ajax-zag-registration-nonce', 'zag-registration');
                ?>
                <br>
                <button id="zag-new-project-prop" type="button" class="btn btn-primary">Submit</button>

            </form>

        </div>

        <!------------------------------------------------------------------------------------------------>

        <div  id="project-draft"  data-prod="x"  class="panel-body zag-project" style="display: none; ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="pr-text">Проект N1 </span>
                    <button data-id="x" type="button" class="btn btn-danger pull-right">Удалить</button>

                </div>
                <div class="panel-body">
                    <div class="form-group">

                        <div class="row">

                            <div class="col-xs-6">
                                <label >Цена за кв метр в $</label>
                                <div class="input-group">

                                    <span class="input-group-addon">$</span>
                                    <input 
                                        type="number" 
                                        name="-priceUS-" 
                                        id="-priceUS-" 
                                        class="form-control" 
                                        min="1"/>
                                </div>
                            </div> 

                            <div class="col-xs-6">
                                <label >Цена за кв метр в грн</label>
                                <div class="input-group">

                                    <span class="input-group-addon">грн</span>
                                    <input 
                                        type="number" 
                                        name="-priceGRN-" 
                                        id="-priceGRN-" 
                                        class="form-control" 
                                        min="1"/>
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
                                        name="-totalSQ-" 
                                        id="-totalSQ-" 
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
                                        name="-liveSQ-" 
                                        id="-liveSQ-" 
                                        class="form-control" 
                                        min="1"/>
                                </div>

                            </div> 

                            <div class="col-xs-6">
                                <label >Осталось</label>
                                <div class="input-group">

                                    <input 
                                        type="number" 
                                        name="proj-left" 
                                        id="proj-left" 
                                        class="form-control" 
                                        />
                                </div>

                            </div> 
                        </div> 

                        <div  class="row">

                            <div class="col-xs-6">

                                <label >Фото проекта</label>
                                <div class="input-group">


                                    <label class="btn btn-default btn-file">
                                        Загрузить <input type="file" style="display: none;" 
                                                         name="oneRoom_file[0]"  class="form-control" >
                                    </label>

                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div data-prev="x" id="oneRoomPreview-0"  class="input-group preview"></div>
                            </div>

                        </div>

                        <div class="form-group">

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
