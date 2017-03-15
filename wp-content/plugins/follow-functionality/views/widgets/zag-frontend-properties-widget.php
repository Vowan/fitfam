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
class Frontend_Properties extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Frontend_Properties ', // Base ID
                __('Frontend_Properties ', 'text_domain'), // Name
                array('description' => __('Frontend Properties!', 'text_domain'),) // Args
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
        ?>

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?> 

                <div class="row">
                    <?php for ($zag_1 = 0; $zag_1 < 4; $zag_1++) : ?> 
                        <?php
                        the_post();

                        $main = get_post_meta($post->ID, "main_prop_features", true);
                        $address = get_post_meta($post->ID, "address_data", true);
                        $rooms_data = get_post_meta($post->ID, "rooms_data", true);

                        //dump($rooms_data);
                        ?>

                        <div class="col-md-3">
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

                                    <div id="carousel-example-generic<?= $post->ID ?>" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">

                                            <?php for ($my_j = 0; $my_j < sizeof($rooms_data); $my_j++): ?>

                                                <li data-target="#carousel-example-generic<?= $post->ID ?>" 
                                                    data-slide-to="<?= $my_j ?>" class="<?php if (0 == $my_j) echo ' active ' ?>"></li>

                                            <?php endfor; ?>         
                                        </ol>

                                        <!-- Wrapper for slides -->
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

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-generic<?= $post->ID ?>" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic<?= $post->ID ?>" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
                        if (!have_posts())
                            break 2;
                        ?>
                    <?php endfor; ?> 

                </div>
            <?php endwhile; ?>
        <?php endif; ?>

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
