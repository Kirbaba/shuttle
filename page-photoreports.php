<?php
/*
Template Name: Страница фото и видео
*/
get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <?php /* The loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php
                if(isset($_GET['mon'])){

                    $a = getdate();
                    $year = $a['year'];
                    $mon = $_GET['mon'];
                    if($_GET['mon'] ==13){
                        $mon = 1;
                    }
                    if($_GET['mon'] == 0){
                        $mon = 12;
                    }
                }
                else{
                    $a = getdate();
                    $year = $a['year'];
                    $mon = $a['mon'];
                }
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <section class="store">
                            <div class="photoreports-page__head">
                                <h1 class="photoreport__zagolovok">Фотоотчеты за <?=get_name_mon($mon)?> <?=$year;?></h1>
                                <a href='?mon=<?=$mon-1;?>' id="mon-left" class="left_arrow"></a>
                                <a href='?mon=<?=$mon+1;?>' id="mon-right" class="right_arrow"></a>
                            </div>

                            <?php echo get_upcoming_other_event($mon,$post->ID);?>
                            <?php
                                $countEarlu = count_report($mon-1);
                                $countNext = count_report($mon+1);
                            ?>
                            <div class="photoreports-page__head">
                                <a href='?mon=<?=$mon-1;?>' id="mon-early" class="early_mon">
                                    <?=get_name_mon($mon-1)?>
                                    <?=$year?>
                                    <?php if($countEarlu>0){
                                    ?>
                                        (<?=$countEarlu?> отчетов)
                                    <?php
                                    }
                                    ?>
                                </a>
                                <a href='?mon=<?=$mon+1;?>' id="mon-next" class="next_mon">
                                    <?=get_name_mon($mon+1)?>
                                    <?=$year?>
                                    <?php if($countNext > 0){
                                        ?>
                                        (<?=$countNext?> отчетов)
                                    <?php
                                    }
                                    ?>
                                </a>
                            </div>
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