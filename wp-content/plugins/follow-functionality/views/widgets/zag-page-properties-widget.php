<?php
/*
  Plugin Name: Zag Frontend Properties
 */

// Block direct requests
if (!defined('ABSPATH'))
    die('-1');

/**
 * Adds My_Widget widget.
 */
class Page_Properties extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Page_Properties ', // Base ID
                __('Page_Properties ', 'text_domain'), // Name
                array('description' => __('Page Properties!', 'text_domain'),) // Args
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
        global $post;

        $my_page_query = new WP_Query(
                array(
            'post_type' => 'zag_property',
            'taxonomy' => 'adress_level',
            'term' => 'odesa',
            'posts_per_page' => '10',
            'post_status' => 'any',
                )
        );

        $prop_koords = array();
        $my_i = 0;
        ?>
        <?php if ($my_page_query->have_posts()) : ?>
            <?php while ($my_page_query->have_posts()) : ?> 

                <div class="row">
                    <?php for ($zag_1 = 0; $zag_1 < 2; $zag_1++) : ?> 
                        <?php
                        $my_page_query->the_post();

                        $main = get_post_meta($post->ID, "main_prop_features", true);
                        $address = get_post_meta($post->ID, "address_data", true);
                        $rooms_data = get_post_meta($post->ID, "rooms_data", true);

                        $prop_koords[$my_i]['lat'] = $address['latitude'];
                        $prop_koords[$my_i]['lng'] = $address['longitude'];
                        $prop_koords[$my_i]['price'] = $main['property_price'];
                        $prop_koords[$my_i]['rooms'] = $main['property_roomN'];
                        $prop_koords[$my_i]['id'] = $post->ID;
                        $my_i++;
                        //
                        ?>

                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php
                                    echo $main['property_roomN'] . " - комнатная";
                                    echo '<br>';
                                    echo "цена - " . $main['property_price'] . " 000 у.е.";
                                    echo '<br>';
                                    echo $address["sublocality_level_1"];
                                    echo '<br>';
                                    echo $address["route"];
                                    ?>
                                </div>
                                <div class="panel-body">
 <!-- 
                                    <div id="carousel-example-generic<?= $post->ID ?>" class="carousel slide" data-ride="carousel">
                                       
                                        <ol class="carousel-indicators">

                                            <?php for ($my_j = 0; $my_j < sizeof($rooms_data); $my_j++): ?>

                                                <li data-target="#carousel-example-generic<?= $post->ID ?>" 
                                                    data-slide-to="<?= $my_j ?>" class="<?php if (0 == $my_j) echo ' active ' ?>"></li>

                                            <?php endfor; ?>         
                                        </ol>

                                        
                                        <div class="carousel-inner" role="listbox">

                                            <?php for ($my_j = 0; $my_j < sizeof($rooms_data); $my_j++): ?>   

                                                <div class="item <?php if (0 == $my_j) echo ' active ' ?>">
                                                    <img src="<?= $rooms_data[$my_j]['room_photo'] ?>   " alt="...">
                                                    <div class="carousel-caption">
                                                        ...
                                                    </div>
                                                </div>
                                            <?php endfor; ?>  

                                        </div>

                                         
                                        <a class="left carousel-control" href="#carousel-example-generic<?= $post->ID ?>" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic<?= $post->ID ?>" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
-->
                                </div>
                            </div>
                        </div>
                        <?php
                        if (!$my_page_query->have_posts())
                            break 2;
                        ?>
                    <?php endfor; ?> 

                </div>
            <?php endwhile; ?>

      <!--      <script>

                var markers_coords = {
            <?php foreach ($prop_koords as $key => $value): ?>
                <?= $key ?>: {coords: {lat: <?= $value['lat'] ?>, lng: <?= $value['lng'] ?>},
                            price: '$<?= $value['price'] ?>k',
                            rooms: '<?= $value['rooms'] ?> - комн.',
                            id:'<?= $value['id'] ?> '
                        },
            <?php endforeach; ?>
                }

            </script> -->
        <?php endif; ?>
        <?php
        //dump($prop_koords);
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
