<?php
get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <?php /* The loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <section class="store">
                            <div class="store__head">

                                <div class="breadcrumbs">
                                    <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
                                </div>
                                <h1 class="blockTitle"><?php the_title(); ?></h1>
                            </div>
                            <div class="store__box">
                                <?php
                                    $img = get_post_meta($post->ID,'images',TRUE);
                                    $img = json_decode($img);?>
                                <div class="slider">
                                    <div class="fotorama" data-nav="thumbs">
                                        <?php
                                            foreach($img as $p){
                                            ?>
                                        <a href="<?=$p;?>"> <img src="<?=$p;?>"></a>
                                            <?
                                            }
                                    ?>
                                    </div>
                                </div>
                                <div class="description">
                                    <?=$post->post_content;?>
                                </div>
                                <hr>
                                <?php
                                    $events = get_post_meta($post->ID,'id_event_hall_fame',TRUE);
                                    $events = explode(',',$events);
                                    $events = array_unique($events);
                                    foreach($events as $ev){
                                        $name_event = get_post( $ev );
                                        $date = get_post_meta($ev,'date',TRUE);
                                        $date = explode('-',$date);
                                        $date = array_reverse($date);
                                        $date = implode(".", $date);
                                        ?>
                                        <div class="event">
                                            <a href="<?=$name_event->guid;?>" class="name_event"><?=$name_event->post_title;?></a>
                                            <span><?=$date;?></span>
                                        </div>
                                    <?php
                                    }
                                ?>

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


<?php get_footer(); ?>