<?php
/*
Template Name: Стол находок
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

                                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                                    <?php /*if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); */?>

                                        <?php if(function_exists('bcn_display'))
                                        {
                                            bcn_display();
                                        }?>

                                    <div class="likely likely-light">
                                        <div class="facebook">Поделиться</div>
                                        <div class="vkontakte">Поделиться</div>
                                    </div>
                                </div>
                                <div class="events-page__head--navline">
                                    <h2><?php the_title(); ?></h2>

                                    <p class="info_found">Справки о найденных вещах по телефону: 24-20-20</p>
                                </div>
                            </div>
                            <div class="store__box lost__found__box">
                                <?php
                                $mypost = array( 'post_type' => 'lost_found','orderby' => 'ID', 'order' => 'ASC' );
                                $loop = new WP_Query( $mypost );
                                foreach($loop->posts as $prod){
                                    $img = get_the_post_thumbnail($prod->ID);
                                    $lostFound = get_post_meta($prod->ID,'lost_found',TRUE);
                                    ?>
                                    <div class="lost_found_wr">
                                       <div class="lost_found_img"> <?=$img;?></div>
                                        <div class="lost_found_info">
                                            <div class="lost_found_title"><?=$prod->post_title;?></div>

                                            <div class="lost_found_description"><?= $prod->post_content;?></div>
                                            <div class="lost_found">
                                                <?php
                                                        if($lostFound == 'found'){
                                                            ?>
                                                                <span class="found">Найдено</span>
                                                            <?
                                                        }
                                                        else{
                                                        ?>
                                                            <a id="go" class="not_found" href="#">Ищу хозяина</a>
                                                           <!-- <span class="not_found">Ищу хозяина</span>-->
                                                        <?
                                                        }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="store__box__info">
                                Если вы обнаружили в этом списке принадлежащую вам вещь — нажмите на кнопку «Оставить заявку», или позвоните по указанному телефону.
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