<?php
/*
Template Name: Страница магазина
*/
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
                                <h1 class="blockTitle">Магазин Shuttle Night Club</h1>
                            </div>
                            <div class="store__box">
                                <?php
                                $mypost = array( 'post_type' => 'product', );
                                $loop = new WP_Query( $mypost );
                                //prn($loop);
                                foreach($loop->posts as $prod){
                                    $img = get_the_post_thumbnail($prod->ID);
                                    $price = get_post_meta($prod->ID,'price',TRUE);
                                    ?>
                                    <div class="store__item">
                                        <a href="#" class="store__item--img">
                                            <?=$img?>
                                        </a>
                                        <div class="store__item--desc">
                                            <p><?=$prod->post_title?></p>
                                            <h5><?=$price?>р.</h5>
                                            <div class="store__item--desc--buy"><a href="#">ОСТАВИТЬ ЗАКАЗ</a></div>
                                        </div>
                                    </div>
                                   <?php
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