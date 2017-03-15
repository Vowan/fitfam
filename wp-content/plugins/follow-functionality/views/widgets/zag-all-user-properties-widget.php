<?php
/*
  Plugin Name: Zag All User Properties
 */

// Block direct requests
if (!defined('ABSPATH'))
    die('-1');

/**
 * Adds My_Widget widget.
 */
class All_User_Properties extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'All_User_Properties ', // Base ID
                __('All_User_Properties ', 'text_domain'), // Name
                array('description' => __('All User Properties!', 'text_domain'),) // Args
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
        global $post;




        $my_query = new WP_Query(
                array(
            'post_type' => 'zag_property',
            'author' => get_current_user_id(),
            'posts_per_page' => '10',
            'post_status' => 'any',
                )
        );
        ?>
        <div class="table-responsive">
            <table id="profile-posts-table" class="table">


                <?php
                $p_index = 1;

                while ($my_query->have_posts()) : $my_query->the_post();

                    //dump($post);

                    $rooms = get_post_meta($post->ID, "rooms_data", true);
                    $address = get_post_meta($post->ID, "address_data", true);
                    $main = get_post_meta($post->ID, "main_prop_features", true);

                    // dump($rooms);
                    // dump($address);
                    // dump($main);
                    ?>


                    <tr>
                        <td class=""><?php echo $p_index ?></td>
                        <td class="">
                            <?php echo $main['property_roomN'] . " - комнатная" ?> 
                            <br>
                            <?php echo "цена - " . $main['property_price'] . " 000 у.е." ?> 
                        </td>
                        <td class=""><?php echo $address["locality"] . ", " . $address["sublocality_level_1"] ?> </td>
                        <td class=""><?php echo $address["route"] . ", " . $address["street_number"] ?> </td>
                        <td class="" data-id="<?= $post->ID ?>"><?php echo $post->post_status ?> </td>
                        <?php if ('publish' == $post->post_status) : ?>
                            <td class=""><button  data-id="<?= $post->ID ?>" data-type="unPublish"  type="button" class="publish btn btn-info">unPublish</button> </td>
                        <?php else: ?>
                            <td class=""><button data-id="<?= $post->ID ?>" data-type="publish"  type="button" class="publish btn btn-success">Publish</button> </td>
                        <?php endif; ?>
                        <td class=""><button data-id="<?= get_post_permalink($post->ID).'&preview=true' ?>" data-type="edit" type="button" class="edit btn btn-warning">Edit</button> </td>
                        <td class=""><button data-id="<?= $post->ID ?>" data-type="delete"  type="button" class="delete btn btn-danger">Delete</button> </td>
                    </tr>
                    <br>

                    <?php
                    $p_index++;
                endwhile;
                ?>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade " id="userProfilePostModal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body" style="height: 800px;">
                        
                        <iframe id="postIframe" src="" class="embed-responsive-item" frameborder="0" style="width: 100%; height: 100%"></iframe>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
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
