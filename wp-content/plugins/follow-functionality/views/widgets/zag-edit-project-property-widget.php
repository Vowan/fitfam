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
class Zag_Edit_Project_Property_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Zag_Edit_Project_Property_Widget', // Base ID
                __('Zag_Edit_Project_Property_Widget', 'text_domain'), // Name
                array('description' => __('Zag_Edit_Project_Property_Widget!', 'text_domain'),) // Args
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

        $project_data = get_post_meta($current_post->ID, 'project_data', true);

        $main_data = get_post_meta($current_post->ID, 'main_data', true);

        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'post_parent' => $current_post->ID,
        ));



        foreach ($attachments as $key => $attach) {

            $room = get_post_meta($attach->ID, 'room', true);

            switch ($room) {
                case 'one-room-file';
                    $one_photo_files[] = wp_get_attachment_url($attach->ID);
                    $one_totalSQ[] = get_post_meta($attach->ID, 'totalSQ', true);
                    $one_liveSQ[] = get_post_meta($attach->ID, 'liveSQ', true);
                    break;
                case 'two-room-file';
                    $two_photo_files[] = wp_get_attachment_url($attach->ID);
                    $two_totalSQ[] = get_post_meta($attach->ID, 'totalSQ', true);
                    $two_liveSQ[] = get_post_meta($attach->ID, 'liveSQ', true);
                    break;
                case 'three-room-file';
                    $three_photo_files[] = wp_get_attachment_url($attach->ID);
                    $three_totalSQ[] = get_post_meta($attach->ID, 'totalSQ', true);
                    $three_liveSQ[] = get_post_meta($attach->ID, 'liveSQ', true);
                    break;
                case 'fore-room-file';
                    $fore_photo_files[] = wp_get_attachment_url($attach->ID);
                    $fore_totalSQ[] = get_post_meta($attach->ID, 'totalSQ', true);
                    $fore_liveSQ[] = get_post_meta($attach->ID, 'liveSQ', true);
                    break;
                case 'pent-room-file';
                    $pent_photo_files[] = wp_get_attachment_url($attach->ID);
                    $pent_totalSQ[] = get_post_meta($attach->ID, 'totalSQ', true);
                    $pent_liveSQ[] = get_post_meta($attach->ID, 'liveSQ', true);
                    break;
            }
        }
        ?>

        <div class="container-fluid">

            <form id="edit-project-form">

                <input type="hidden" name="latitude" id="latitude"  value="<?= $address_data['latitude'] ?>"/>	
                <input type="hidden" name="longitude" id="longitude" value="<?= $address_data['longitude'] ?>"/>	
                <input type="hidden" name="post_id" id="post_id" value="<?= $current_post->ID ?>"/>



                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align: center;">Редактировать Новострой</div>
                        </div>
                    </div>
                </div> <!-- Kind of prop -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Титульное сообщение</div>
                            <div class="panel-body">
                                <div class="input-group" style="width: 100%;">

                                    <input 
                                        type="text"
                                        name="shot_title"
                                        id="shot_title" 
                                        class="form-control" 
                                        value="<?= $main_data['shot_title'] ?>" 

                                        />	

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!--Title panel -->


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
                                <div class="row">

                                    <div class="col-xs-4">
                                        <label >номер дома</label>
                                        <div class="input-group">

                                            <input type="text" 
                                                   name="street_number" 
                                                   id="street_number" 
                                                   class="form-control" 
                                                   value="<?= $address_data['street_number'] ?>" 
                                                   disabled
                                                   />
                                        </div>
                                    </div> 

                                    <div class="col-xs-8">
                                        <label >улица</label>
                                        <div class="input-group">

                                            <input type="text" 
                                                   name="route" 
                                                   id="route" 
                                                   class="form-control" 
                                                   value="<?= $address_data['route'] ?>" 
                                                   disabled
                                                   />
                                        </div>

                                    </div> 
                                </div> 
                                <div class="row">

                                    <div class="col-xs-4">
                                        <label>город</label>
                                        <div class="input-group">

                                            <input type="text" 
                                                   name="locality" 
                                                   id="locality" 
                                                   class="form-control" 
                                                   value="<?= $address_data['locality'] ?>" 
                                                   disabled
                                                   />
                                        </div>
                                    </div> 

                                    <div class="col-xs-8">
                                        <label >район</label>
                                        <div class="input-group">

                                            <input type="text" 
                                                   name="sublocality_level_1" 
                                                   id="sublocality_level_1" 
                                                   class="form-control" 
                                                   value="<?= $address_data['sublocality_level_1'] ?>" 
                                                   disabled
                                                   />
                                        </div>

                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div>
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
                                                       value="<?= $user_data['user_first_name'] ?>" />
                                            </div>
                                        </div> 

                                        <div class="col-xs-7">
                                            <label >Фамилия </label>
                                            <div class="input-group">

                                                <input type="text" 
                                                       name="user_last_name" 
                                                       id="user_last_name" 
                                                       class="form-control" 
                                                       value="<?= $user_data['user_last_name'] ?>" />
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
                                                       value="<?= $user_data['user_tel'] ?>" />
                                            </div>
                                        </div> 

                                        <div class="col-xs-7">
                                            <label >Email</label>
                                            <div class="input-group">

                                                <input type="email" 
                                                       name="user_email" 
                                                       id="user_email" 
                                                       class="form-control" 
                                                       value="<?= $user_data['user_email'] ?>" />	
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
                                                       value="<?= $user_data['skype'] ?>" />
                                            </div>
                                        </div> 

                                        <div class="col-xs-7">
                                            <label >Вайбер</label>
                                            <div class="input-group">

                                                <input type="text" 
                                                       name="viber" 
                                                       id="viber" 
                                                       class="form-control" 
                                                       value="<?= $user_data['viber'] ?>" />	
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
                </div> <!-- final address -->

                <?php if ($project_data['one-room-file']): ?>


                    <div class="row">
                        <div class="col-sm-6">
                            <?php if ($one_photo_files): ?>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div id="carousel-one-room" class="carousel slide" data-ride="carousel">
                                            <!-- Indicators -->
                                            <ol class="carousel-indicators">
                                                <?php foreach ($one_photo_files as $index => $photo): ?>
                                                    <li data-target="#carousel-one-room" data-slide-to="<?= $index ?>"
                                                        class="<?php if (0 == $index) echo 'active'; ?>"></li>

                                                <?php endforeach; ?> 
                                            </ol>

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">

                                                <?php foreach ($one_photo_files as $index => $photo): ?>
                                                    <div class="item <?php if (0 == $index) echo 'active'; ?>">
                                                        <img src="<?= $photo ?>" alt="..." style="height: 300px;">
                                                        <div class="carousel-caption">
                                                            <h3><?= $room[$index] ?></h3><h3><?= $roomSQ[$index] ?></h3>
                                                        </div>
                                                    </div>

                                                <?php endforeach; ?> 

                                            </div>

                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#carousel-one-room" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-one-room" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <?php foreach ($project_data['one-room-file'] as $key => $photo): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="pr-text">Проект N<?= $key + 1 ?> </span>
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
                                                            name="one-room-priceUS[]" 
                                                            id="one-room-priceUS" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['one-room-file'][$key]['priceUS'] ?>"
                                                            />
                                                    </div>
                                                </div> 

                                                <div class="col-xs-6">
                                                    <label >Цена за кв метр в грн</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon">грн</span>
                                                        <input 
                                                            type="number" 
                                                            name="one-room-priceGRN[]" 
                                                            id="one-room-priceGRN" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['one-room-file'][$key]['priceGRN'] ?>"

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
                                                            name="one-room-totalSQ[]" 
                                                            id="one-room-totalSQ" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['one-room-file'][$key]['totalSQ'] ?>"

                                                            />
                                                    </div>
                                                </div> 

                                                <div class="col-xs-6">
                                                    <label >Жилая площадь</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon">м2</span>
                                                        <input 
                                                            type="number" 
                                                            name="one-room-liveSQ[]" 
                                                            id="one-room-liveSQ" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['one-room-file'][$key]['liveSQ'] ?>"

                                                            />
                                                    </div>

                                                </div> 
                                                
                                                <div class="col-xs-6">
                                                    <label >Осталось</label>
                                                    <div class="input-group">

                                                        
                                                        <input 
                                                            type="number" 
                                                            name="one-room-proj-left[]" 
                                                            id="one-room-proj-left" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['one-room-file'][$key]['proj-left'] ?>"

                                                            />
                                                    </div>

                                                </div> 
                                            </div> 


                                            <div class="form-group">

                                                <div class="row">
                                                    <label for="comment">Краткое описание:</label>
                                                    <textarea 
                                                        class="form-control" 
                                                        rows="5" 
                                                        id="one-room-comment"
                                                        name="one-room-comment[]" 
                                                        ><?= $project_data['one-room-file'][$key]['comment'] ?></textarea>
                                                </div>

                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            <?php endforeach; ?> 
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($project_data['two-room-file']): ?>


                    <div class="row">
                        <div class="col-sm-6">
                            <?php if ($two_photo_files): ?>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div id="carousel-two-room" class="carousel slide" data-ride="carousel">
                                            <!-- Indicators -->
                                            <ol class="carousel-indicators">
                                                <?php foreach ($two_photo_files as $index => $photo): ?>
                                                    <li data-target="#carousel-two-room" data-slide-to="<?= $index ?>"
                                                        class="<?php if (0 == $index) echo 'active'; ?>"></li>

                                                <?php endforeach; ?> 
                                            </ol>

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">

                                                <?php foreach ($two_photo_files as $index => $photo): ?>
                                                    <div class="item <?php if (0 == $index) echo 'active'; ?>">
                                                        <img src="<?= $photo ?>" alt="..." style="height: 300px;">
                                                        <div class="carousel-caption">
                                                            <h3><?= $room[$index] ?></h3><h3><?= $roomSQ[$index] ?></h3>
                                                        </div>
                                                    </div>

                                                <?php endforeach; ?> 

                                            </div>

                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#carousel-two-room" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-two-room" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <?php foreach ($project_data['two-room-file'] as $key => $photo): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="pr-text">Проект N<?= $key + 1 ?> </span>
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
                                                            name="two-room-priceUS[]" 
                                                            id="two-room-priceUS" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['two-room-file'][$key]['priceUS'] ?>"
                                                            />
                                                    </div>
                                                </div> 

                                                <div class="col-xs-6">
                                                    <label >Цена за кв метр в грн</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon">грн</span>
                                                        <input 
                                                            type="number" 
                                                            name="two-room-priceGRN[]" 
                                                            id="two-room-priceGRN" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['two-room-file'][$key]['priceGRN'] ?>"

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
                                                            name="two-room-totalSQ[]" 
                                                            id="two-room-totalSQ" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['two-room-file'][$key]['totalSQ'] ?>"

                                                            />
                                                    </div>
                                                </div> 

                                                <div class="col-xs-6">
                                                    <label >Жилая площадь</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon">м2</span>
                                                        <input 
                                                            type="number" 
                                                            name="two-room-liveSQ[]" 
                                                            id="two-room-liveSQ" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['two-room-file'][$key]['liveSQ'] ?>"

                                                            />
                                                    </div>

                                                </div> 
                                                <div class="col-xs-6">
                                                    <label >Осталось</label>
                                                    <div class="input-group">

                                                        
                                                        <input 
                                                            type="number" 
                                                            name="two-room-proj-left[]" 
                                                            id="two-room-proj-left" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['two-room-file'][$key]['proj-left'] ?>"

                                                            />
                                                    </div>

                                                </div> 
                                            </div> 


                                            <div class="form-group">

                                                <div class="row">
                                                    <label for="comment">Краткое описание:</label>
                                                    <textarea 
                                                        class="form-control" 
                                                        rows="5" 
                                                        id="two-room-comment"
                                                        name="two-room-comment[]" 
                                                        ><?= $project_data['two-room-file'][$key]['comment'] ?></textarea>
                                                </div>

                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            <?php endforeach; ?> 

                        </div>
                    </div>

                <?php endif; ?> 

                <?php if ($project_data['three-room-file']): ?>


                    <div class="row">
                        <div class="col-sm-6">
                            <?php if ($three_photo_files): ?>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div id="carousel-three-room" class="carousel slide" data-ride="carousel">
                                            <!-- Indicators -->
                                            <ol class="carousel-indicators">
                                                <?php foreach ($three_photo_files as $index => $photo): ?>
                                                    <li data-target="#carousel-three-room" data-slide-to="<?= $index ?>"
                                                        class="<?php if (0 == $index) echo 'active'; ?>"></li>

                                                <?php endforeach; ?> 
                                            </ol>

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">

                                                <?php foreach ($three_photo_files as $index => $photo): ?>
                                                    <div class="item <?php if (0 == $index) echo 'active'; ?>">
                                                        <img src="<?= $photo ?>" alt="..." style="height: 300px;">
                                                        <div class="carousel-caption">
                                                            <h3><?= $room[$index] ?></h3><h3><?= $roomSQ[$index] ?></h3>
                                                        </div>
                                                    </div>

                                                <?php endforeach; ?> 

                                            </div>

                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#carousel-three-room" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-three-room" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <?php foreach ($project_data['three-room-file'] as $key => $photo): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="pr-text">Проект N<?= $key + 1 ?> </span>
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
                                                            name="three-room-priceUS[]" 
                                                            id="three-room-priceUS" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['three-room-file'][$key]['priceUS'] ?>"
                                                            />
                                                    </div>
                                                </div> 

                                                <div class="col-xs-6">
                                                    <label >Цена за кв метр в грн</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon">грн</span>
                                                        <input 
                                                            type="number" 
                                                            name="three-room-priceGRN[]" 
                                                            id="three-room-priceGRN" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['three-room-file'][$key]['priceGRN'] ?>"

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
                                                            name="three-room-totalSQ[]" 
                                                            id="three-room-totalSQ" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['three-room-file'][$key]['totalSQ'] ?>"

                                                            />
                                                    </div>
                                                </div> 

                                                <div class="col-xs-6">
                                                    <label >Жилая площадь</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon">м2</span>
                                                        <input 
                                                            type="number" 
                                                            name="three-room-liveSQ[]" 
                                                            id="three-room-liveSQ" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['three-room-file'][$key]['liveSQ'] ?>"

                                                            />
                                                    </div>

                                                </div> 
                                                
                                                 <div class="col-xs-6">
                                                    <label >Осталось</label>
                                                    <div class="input-group">

                                                        
                                                        <input 
                                                            type="number" 
                                                            name="three-room-proj-left[]" 
                                                            id="three-room-proj-left" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['three-room-file'][$key]['proj-left'] ?>"

                                                            />
                                                    </div>

                                                </div> 
                                                
                                            </div> 


                                            <div class="form-group">

                                                <div class="row">
                                                    <label for="comment">Краткое описание:</label>
                                                    <textarea 
                                                        class="form-control" 
                                                        rows="5" 
                                                        id="three-room-comment"
                                                        name="three-room-comment[]" 
                                                        ><?= $project_data['three-room-file'][$key]['comment'] ?></textarea>
                                                </div>

                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            <?php endforeach; ?> 

                        </div>
                    </div>

                <?php endif; ?> 

                <?php if ($project_data['fore-room-file']): ?>


                    <div class="row">
                        <div class="col-sm-6">
                            <?php if ($fore_photo_files): ?>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div id="carousel-fore-room" class="carousel slide" data-ride="carousel">
                                            <!-- Indicators -->
                                            <ol class="carousel-indicators">
                                                <?php foreach ($fore_photo_files as $index => $photo): ?>
                                                    <li data-target="#carousel-fore-room" data-slide-to="<?= $index ?>"
                                                        class="<?php if (0 == $index) echo 'active'; ?>"></li>

                                                <?php endforeach; ?> 
                                            </ol>

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">

                                                <?php foreach ($fore_photo_files as $index => $photo): ?>
                                                    <div class="item <?php if (0 == $index) echo 'active'; ?>">
                                                        <img src="<?= $photo ?>" alt="..." style="height: 300px;">
                                                        <div class="carousel-caption">
                                                            <h3><?= $room[$index] ?></h3><h3><?= $roomSQ[$index] ?></h3>
                                                        </div>
                                                    </div>

                                                <?php endforeach; ?> 

                                            </div>

                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#carousel-fore-room" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-fore-room" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <?php foreach ($project_data['fore-room-file'] as $key => $photo): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="pr-text">Проект N<?= $key + 1 ?> </span>
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
                                                            name="fore-room-priceUS[]" 
                                                            id="fore-room-priceUS" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['fore-room-file'][$key]['priceUS'] ?>"
                                                            />
                                                    </div>
                                                </div> 

                                                <div class="col-xs-6">
                                                    <label >Цена за кв метр в грн</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon">грн</span>
                                                        <input 
                                                            type="number" 
                                                            name="fore-room-priceGRN[]" 
                                                            id="fore-room-priceGRN" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['fore-room-file'][$key]['priceGRN'] ?>"

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
                                                            name="fore-room-totalSQ[]" 
                                                            id="fore-room-totalSQ" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['fore-room-file'][$key]['totalSQ'] ?>"

                                                            />
                                                    </div>
                                                </div> 

                                                <div class="col-xs-6">
                                                    <label >Жилая площадь</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon">м2</span>
                                                        <input 
                                                            type="number" 
                                                            name="fore-room-liveSQ[]" 
                                                            id="fore-room-liveSQ" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['fore-room-file'][$key]['liveSQ'] ?>"

                                                            />
                                                    </div>

                                                </div> 
                                                
                                                 <div class="col-xs-6">
                                                    <label >Осталось</label>
                                                    <div class="input-group">

                                                        
                                                        <input 
                                                            type="number" 
                                                            name="fore-room-proj-left[]" 
                                                            id="fore-room-proj-left" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['fore-room-file'][$key]['proj-left'] ?>"

                                                            />
                                                    </div>

                                                </div> 
                                            </div> 


                                            <div class="form-group">

                                                <div class="row">
                                                    <label for="comment">Краткое описание:</label>
                                                    <textarea 
                                                        class="form-control" 
                                                        rows="5" 
                                                        id="fore-room-comment"
                                                        name="fore-room-comment[]" 
                                                        ><?= $project_data['fore-room-file'][$key]['comment'] ?></textarea>
                                                </div>

                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            <?php endforeach; ?> 

                        </div>
                    </div>

                <?php endif; ?> 

                <?php if ($project_data['pent-room-file']): ?>


                    <div class="row">
                        <div class="col-sm-6">
                            <?php if ($pent_photo_files): ?>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div id="carousel-pent-room" class="carousel slide" data-ride="carousel">
                                            <!-- Indicators -->
                                            <ol class="carousel-indicators">
                                                <?php foreach ($pent_photo_files as $index => $photo): ?>
                                                    <li data-target="#carousel-pent-room" data-slide-to="<?= $index ?>"
                                                        class="<?php if (0 == $index) echo 'active'; ?>"></li>

                                                <?php endforeach; ?> 
                                            </ol>

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">

                                                <?php foreach ($pent_photo_files as $index => $photo): ?>
                                                    <div class="item <?php if (0 == $index) echo 'active'; ?>">
                                                        <img src="<?= $photo ?>" alt="..." style="height: 300px;">
                                                        <div class="carousel-caption">
                                                            <h3><?= $room[$index] ?></h3><h3><?= $roomSQ[$index] ?></h3>
                                                        </div>
                                                    </div>

                                                <?php endforeach; ?> 

                                            </div>

                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#carousel-pent-room" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-pent-room" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <?php foreach ($project_data['pent-room-file'] as $key => $photo): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="pr-text">Проект N<?= $key + 1 ?> </span>
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
                                                            name="pent-room-priceUS[]" 
                                                            id="pent-room-priceUS" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['pent-room-file'][$key]['priceUS'] ?>"
                                                            />
                                                    </div>
                                                </div> 

                                                <div class="col-xs-6">
                                                    <label >Цена за кв метр в грн</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon">грн</span>
                                                        <input 
                                                            type="number" 
                                                            name="pent-room-priceGRN[]" 
                                                            id="pent-room-priceGRN" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['pent-room-file'][$key]['priceGRN'] ?>"

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
                                                            name="pent-room-totalSQ[]" 
                                                            id="pent-room-totalSQ" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['pent-room-file'][$key]['totalSQ'] ?>"

                                                            />
                                                    </div>
                                                </div> 

                                                <div class="col-xs-6">
                                                    <label >Жилая площадь</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon">м2</span>
                                                        <input 
                                                            type="number" 
                                                            name="pent-room-liveSQ[]" 
                                                            id="pent-room-liveSQ" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['pent-room-file'][$key]['liveSQ'] ?>"

                                                            />
                                                    </div>

                                                </div> 
                                                
                                                 <div class="col-xs-6">
                                                    <label >Осталось</label>
                                                    <div class="input-group">

                                                        
                                                        <input 
                                                            type="number" 
                                                            name="pent-room-proj-left[]" 
                                                            id="pent-room-proj-left" 
                                                            class="form-control" 
                                                            min="1"
                                                            value="<?= $project_data['pent-room-file'][$key]['proj-left'] ?>"

                                                            />
                                                    </div>

                                                </div> 
                                            </div> 


                                            <div class="form-group">

                                                <div class="row">
                                                    <label for="comment">Краткое описание:</label>
                                                    <textarea 
                                                        class="form-control" 
                                                        rows="5" 
                                                        id="pent-room-comment"
                                                        name="pent-room-comment[]" 
                                                        ><?= $project_data['pent-room-file'][$key]['comment'] ?></textarea>
                                                </div>

                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            <?php endforeach; ?> 

                        </div>
                    </div>

                <?php endif; ?> 

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
                <br>
                <button id="zag-edit-project-prop" type="button" class="btn btn-primary">Сохранить редактирование</button>
                <button id="zag-unpublish-project-prop" type="button" class="btn btn-warning">В архив</button>
                <button id="zag-delete-project-prop" type="button" class="btn btn-danger">Удалить</button>

            </form>

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
