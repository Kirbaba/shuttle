<?php
/*
Template Name: Шаблон страниц
*/
get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <?php /* The loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <section class="store about_club">
                            <div class="breadcrumbs">
                                <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
                            </div>
                                <?php the_content();?>

                        </section>
                    </div>

                </article><!-- #post -->

                <?php /*comments_template(); */?>
            <?php endwhile; ?>

        </div><!-- #content -->
    </div><!-- #primary -->


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