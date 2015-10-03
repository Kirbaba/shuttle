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
                                            <div class="store__item--desc--buy"><a name-tovar="<?=$prod->post_title?>" id="go" class="leave_order" href="#">ОСТАВИТЬ ЗАКАЗ</a></div>
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