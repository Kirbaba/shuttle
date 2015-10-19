<?php
/*
Template Name: Доска почета
*/

get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <?php /* The loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <section class="store">
                            <div class="events-page__head">

                                <div class="breadcrumbs">
                                    <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
                                </div>
                                <div class="events-page__head--navline">
                                    <h2><?php the_title(); ?></h2>

                                </div>
                            </div>
                            <div class="store__box">
                                <?php
                                $mypost = array( 'post_type' => 'hall_fame','orderby' => 'ID', 'order' => 'ASC','posts_per_page' => -1 );
                                $loop = new WP_Query( $mypost );
                                //prn($loop->posts);
                                $i = 1;
                                foreach($loop->posts as $prod){
                                    $lostFound = get_post_meta($prod->ID,'images',TRUE);
                                    $lostFound = json_decode($lostFound);
                                    if($i > 10){
                                        $i = 1;
                                    }
                                    if($i == 1) {
                                        ?>
                                        <div class="hall_fame_one">
                                            <a href="<?=$prod->guid;?>">
                                                <img src="<?= $lostFound[0]; ?>">
                                                <span class="title"><?=$prod->post_title;?></span>
                                                <img class="hover_hall_fame" src="<?=get_template_directory_uri();?>/img/events_hover.png" alt=""/>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    if($i == 2) {
                                        ?>
                                        <div class="hall_fame_second">
                                            <a href="<?=$prod->guid;?>">
                                                <img src="<?= $lostFound[0]; ?>">
                                                <span class="title"><?=$prod->post_title;?></span>
                                                <img class="hover_hall_fame" src="<?=get_template_directory_uri();?>/img/events_hover.png" alt=""/>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    if($i == 3) {
                                        ?>
                                        <div class="hall_fame_third">
                                            <a href="<?=$prod->guid;?>">
                                                <img src="<?= $lostFound[0]; ?>">
                                                <span class="title"><?=$prod->post_title;?></span>
                                                <img class="hover_hall_fame" src="<?=get_template_directory_uri();?>/img/events_hover.png" alt=""/>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    if($i == 4) {
                                        ?>
                                        <div class="hall_fame_fourth">
                                            <a href="<?=$prod->guid;?>">
                                                <img src="<?= $lostFound[0]; ?>">
                                                <span class="title"><?=$prod->post_title;?></span>
                                                <img class="hover_hall_fame" src="<?=get_template_directory_uri();?>/img/events_hover.png" alt=""/>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    if($i == 5) {
                                        ?>
                                        <div class="hall_fame_fifth">
                                            <a href="<?=$prod->guid;?>">
                                                <img src="<?= $lostFound[0]; ?>">
                                                <span class="title"><?=$prod->post_title;?></span>
                                                <img class="hover_hall_fame" src="<?=get_template_directory_uri();?>/img/events_hover.png" alt=""/>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    if($i == 6) {
                                        ?>
                                        <div class="hall_fame_sixth">
                                            <a href="<?=$prod->guid;?>">
                                                <img src="<?= $lostFound[0]; ?>">
                                                <span class="title"><?=$prod->post_title;?></span>
                                                <img class="hover_hall_fame" src="<?=get_template_directory_uri();?>/img/events_hover.png" alt=""/>
                                            </a>
                                        </div>

                                    <?php
                                    }
                                    ?>


                                    <?php if($i == 7) {
                                        ?>
                                        <div class="wapper_fame_hall">
                                        <div class="hall_fame_seventh">
                                            <a href="<?=$prod->guid;?>">
                                                <img src="<?= $lostFound[0]; ?>">
                                                <span class="title"><?=$prod->post_title;?></span>
                                                <img class="hover_hall_fame" src="<?=get_template_directory_uri();?>/img/events_hover.png" alt=""/>
                                            </a>
                                        </div>
                                        <div class="cleared"></div>
                                    <?php
                                    }
                                    if($i == 8) {
                                        ?>
                                        <div class="hall_fame_eighth">
                                            <a href="<?=$prod->guid;?>">
                                                <img src="<?= $lostFound[0]; ?>">
                                                <span class="title"><?=$prod->post_title;?></span>
                                                <img class="hover_hall_fame" src="<?=get_template_directory_uri();?>/img/events_hover.png" alt=""/>
                                            </a>
                                        </div>

                                    <?php
                                    }
                                    if($i == 9) {
                                        ?>
                                        <div class="hall_fame_ninth">
                                            <a href="<?=$prod->guid;?>">
                                                <img src="<?= $lostFound[0]; ?>">
                                                <span class="title"><?=$prod->post_title;?></span>
                                                <img class="hover_hall_fame" src="<?=get_template_directory_uri();?>/img/events_hover.png" alt=""/>
                                            </a>
                                        </div>
                                    <?php
                                    } ?>

                                    <?php
                                        if($i == 10) {
                                        ?>
                                            </div>
                                        <div class="hall_fame_tenth">
                                            <a href="<?=$prod->guid;?>">
                                                <img src="<?= $lostFound[0]; ?>">
                                                <span class="title"><?=$prod->post_title;?></span>
                                                <img class="hover_hall_fame" src="<?=get_template_directory_uri();?>/img/events_hover.png" alt=""/>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                        ?>
                                <?php

                                $i++;


                                }
                                ?>

                            </div>
                        </section>
                    </div><!-- .entry-content -->


                </article><!-- #post -->

                <?php /*comments_template(); */?>
            <?php endwhile; ?>

        </div><!-- #content -->
    </div><!-- #primary -->

    <div id="modal_form"><!-- Сaмo oкнo -->
        <div id="orderProduct" nameProduct=""></div>
        <span id="modal_close"><i class="fa fa-times"></i></span> <!-- Кнoпкa зaкрыть -->
        <h4 class="titleorder">СДЕЛАТЬ ЗАКАЗ</h4>
        <form>
            <p>Введите ваше имя
                <br /><input type="text" name="name" id="nameOrder" required/></p>
            <p>Введите телефон для связи
                <br /><input type="text" name="telephone" id="telephoneOrder" required/></p>
            <p>Введите Email
                <br /><input type="email" name="email" id="emailOrder" required/></p>
            <input type="button" name="" id="buttomOrder" value="Сделать заказ"/>
        </form>
        <!-- Тут любoе сoдержимoе -->
    </div>
    <script type="text/javascript">
        addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
        var ajaxurl = '/wp-admin/admin-ajax.php',
            pagenow = 'toplevel_page_mainpage',
            typenow = '',
            adminpage = 'toplevel_page_mainpage',
            thousandsSeparator = ' ',
            decimalPoint = ',',
            isRtl = 0;
    </script>
<?php get_footer(); ?>