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
class Zag_Edit_Property_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Zag_Edit_Property_Widget', // Base ID
                __('Zag_Edit_Property_Widget', 'text_domain'), // Name
                array('description' => __('Zag_Edit_Property_Widget!', 'text_domain'),) // Args
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

        $current_post = sanitize_post($GLOBALS['wp_the_query']->get_queried_object());

        $address = get_post_meta($current_post->ID, "address_data", true);
        $main_prop_features = get_post_meta($current_post->ID, "main_prop_features", true);
        $user_info = get_post_meta($current_post->ID, "user_info", true);

        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'post_parent' => $current_post->ID,
        ));

        $prop_imgs = array();

        foreach ($attachments as $key => $attach) {

            $room_name = get_post_meta($attach->ID, 'room')[0];

            switch ($room_name) {

                case 'bath':
                    $prop_imgs[$key]['room'] = $zag_domain == "rus" ? 'ванная' : 'ванна';
                    break;
                case 'kitchen':
                    $prop_imgs[$key]['room'] = $zag_domain == "rus" ? 'кухня' : 'кухня';
                    break;
                case 'dining':
                    $prop_imgs[$key]['room'] = $zag_domain == "rus" ? 'столовая' : 'їдальня';
                    break;
                case 'sitting':
                    $prop_imgs[$key]['room'] = $zag_domain == "rus" ? 'гостинная' : 'вітальня';
                    break;
                case 'bedroom':
                    $prop_imgs[$key]['room'] = $zag_domain == "rus" ? 'спальня' : 'спальня';
                    break;
            }

            $prop_imgs[$key]['room_sq'] = get_post_meta($attach->ID, 'room_sq')[0];

            $prop_imgs[$key]['image'] = wp_get_attachment_image_src($attach->ID, 'img-prop-size')[0];
            //  $prop_imgs[$key]['thumb'] = wp_get_attachment_image_src($attach->ID, 'thumbnail')[0];
        }
        ?>

        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-6">

                    <!-- 
                    
                                        <input id="autocomplete" placeholder="Enter your address" class="form-control"
                                               onFocus="geolocate()" type="text"></input>
                    
                    
                    
                                        <div id="map"></div>
                                        <br>-->

                    <div id="prop-slider" class="carousel slide" >
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php
                            foreach ($prop_imgs as $key => $value) {
                                $activ_class = '';
                                if (0 == $key) {
                                    $activ_class = 'active';
                                }
                                ?> 

                                <li data-target = "#carousel-example-generic" data-slide-to = "<?= $key ?>" class = "<?= $activ_class ?>"></li>
                                <?php
                            }
                            ?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">

                            <?php
                            foreach ($prop_imgs as $key => $value) {
                                $activ_class = '';
                                if (0 == $key) {
                                    $activ_class = 'active';
                                }
                                ?> 

                                <div class="item <?= $activ_class ?>">
                                    <img src="<?= $aa = $value['image'] ?>" alt="...">
                                    <div class="carousel-caption">
                                        <h3><?= $prop_imgs['room'] ?></h3>
                                        <h3><?= $prop_imgs['room_sq'] ?></h3>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                        </div>

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

                    <div  class="row">  <label>Адрес</label>
                        <address id="prop_address"> 
                            <?= $address['street_number'] ?><br>
                            <?= $address['route'] ?><br>
                            <?= $address['sublocality_level_1'] ?><br>
                            <?= $address['administrative_area_level_1'] ?><br>
                            <?= $address['country'] ?><br>


                        </address> 
                    </div>


                    <form id="new-property-form">

                           <div class="form-group">
                            <div class="row">
                                <div class="input-group">
                                    <label >Имя контактного лица</label>
                                    <input type="text" 
                                           name="user_first_name" 
                                           id="shot_title" 
                                           class="form-control" 
                                           value="<?= $user_info['user_first_name'] ?>" />	
                                </div>  
                                <div class="input-group">
                                    <label >Фамилия контактного лица</label>
                                    <input type="text" 
                                           name="user_last_name" 
                                           id="shot_title" 
                                           class="form-control" 
                                           value="<?= $user_info['user_last_name']?>" />
                                </div>
                                <div class="input-group">
                                    <label >Телефон</label>
                                    <input type="number" 
                                           name="user_tel" 
                                           id="shot_title" 
                                           class="form-control" 
                                           value="<?= $user_info['user_tel'] ?>" />	
                                </div>
                                <div class="input-group">
                                    <label >Email</label>
                                    <input type="email" 
                                           name="user_email" 
                                           id="shot_title" 
                                           class="form-control" 
                                           value="<?= $user_info['user_email']  ?>" />	
                                </div>
                                <div class="input-group">
                                    <label >Агенство</label>
                                    <input type="text" 
                                           name="user_agency" 
                                           id="shot_title" 
                                           class="form-control" 
                                           value="<?= $user_info['user_agency']  ?>" />	
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="input-group">
                                    <label >Титульное сообщение</label>
                                    <input type="text" 
                                           name="shot_title" 
                                           id="shot_title" 
                                           class="form-control" 
                                            value="<?= $main_prop_features['shot_title']  ?>"  />	


                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">

                                <div class="col-xs-6">

                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="number" 
                                               name="property_price" 
                                               id="property_price"
                                               class="form-control" 
                                               value="<?= $main_prop_features['property_price']  ?>"  />	
                                        <span class="input-group-addon">.000</span>
                                    </div> 
                                </div> 

                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">грн.</span>
                                        <input type="number" 
                                               name="property_price_gry" 
                                               id="property_price" 
                                               class="form-control"
                                                value="<?= $main_prop_features['property_price_gry'] ?>" />	
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
                                        <input type="number" 
                                               name="property_roomN" 
                                               id="property_roomN" 
                                               class="form-control"
                                                min="1" max="10"  
                                                value="<?= $main_prop_features['property_roomN'] ?>" />	
                                        <span class="input-group-addon">комнат</span>

                                    </div>
                                </div> 

                                <div class="col-xs-6">

                                    <div class="input-group">
                                        <span class="input-group-addon">N</span>
                                        <input type="text" 
                                               name="house_level" 
                                               id="property_roomN"
                                               class="form-control"
                                               value="<?= $main_prop_features['house_level'] ?>" />	
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
                                        <input type="number" 
                                               name="total_sq" 
                                               id="property_price" 
                                               class="form-control" 
                                                value="<?= $main_prop_features['total_sq'] ?> " />	
                                        <span class="input-group-addon">m2</span>
                                    </div> 
                                </div>

                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">Жилая</span>
                                        <input type="number" 
                                               name="life_sq" 
                                               id="property_price" 
                                               class="form-control" 
                                              value="<?= $main_prop_features['life_sq'] ?>"  />	
                                        <span class="input-group-addon">m2</span>
                                    </div> 
                                </div>



                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <label for="comment">Краткое описание:</label>
                                <textarea class="form-control" 
                                          rows="5" 
                                          name="comment" 
                                          value="<?= $main_prop_features['comment'] ?> "/>
                                              
                                </textarea>
                            </div>

                        </div>

                       

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
