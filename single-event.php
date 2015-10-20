

<?php
get_header(); // Пoдключaeм хeдeр?>

<!--<script type="text/javascript">
    hs.graphicsDir = '<?/*=get_template_directory_uri()*/?>/highslide/graphics/';
    hs.align = 'center';
    hs.transitions = ['expand', 'crossfade'];
    hs.wrapperClassName = 'dark borderless floating-caption';
    hs.fadeInOut = true;
    hs.dimmingOpacity = .75;
    hs.showCredits = false;

    // Add the controlbar
    if (hs.addSlideshow) hs.addSlideshow({
        //slideshowGroup: 'group1',
        interval: 5000,
        repeat: false,
        useControls: true,
        fixedControls: 'fit',
        overlayOptions: {
            opacity: .6,
            position: 'bottom center',
            hideOnMouseOut: true
        }
    });
</script>-->



<?php if ( have_posts() ) while ( have_posts() ) : the_post(); // Нaчaлo cтaндaртнoгo циклa ?>
    <?php
        $dateish = get_post_meta( $post->ID, 'date', true );
        $date = explode('-',$dateish);
        if($date[2][0] == 0){
            $number = $date[2][1];
        }
        else{
            $number = $date[2];
        }
        if($date[1][0] == 0){
            $mon = $date[1][1];
        }
        else{
            $mon = $date[1];
        }
    ?>
    <section class="events-page">
        <div class="events-page__head">
            <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
<!--            <div class="breadcrumbs">-->
<!--                --><?php //if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
<!--                <div class="likely likely-light">-->
<!--                    <div class="facebook">Поделиться</div>-->
<!--                    <div class="vkontakte">Поделиться</div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="events-page__head--navline">
                <h2><?php the_title(); ?></h2>
                <h5><?=$number?> <?=name_mon($mon)?></h5>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#description" class="events-page__head--but activeTab"  data-toggle="tab">Описание</a></li>


                <!--<a href="#" class="events-page__head--but activeTab" data-id="<?/*=$post->ID;*/?>" id="descriptionEvent">Описание</a>-->
                <?php
                    $photo = new Photo_report();
                    $k = $photo->get_empty_report($post->ID);
                    if($k == 1){
                        ?>
                        <li><a href="#fotoreport" class="events-page__head--but" id="photoreportEvent"  data-toggle="tab">Фотоотчет</a></li>

                        <?
                    }
                ?>
                </ul>
            </div>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="description">
                <div class="events-page__box">

                    <?=$post->post_content;?>

                </div>
                <?php
              upcoming_events($mon,$post->ID);
                echo get_parent($post->ID);
                ?>
            </div>

            <div class="tab-pane" id="fotoreport">
               <?php show_report($post->ID);?>
                <div class="coments_wr">
                    <div class="coments">
                        <!-- Put this script tag to the <head> of your page -->
                        <script type="text/javascript" src="//vk.com/js/api/openapi.js?117"></script>

                        <script type="text/javascript">
                            VK.init({apiId: 5105016, onlyWidgets: true});
                        </script>

                        <!-- Put this div tag to the place, where the Comments block will be -->
                        <div id="vk_comments"></div>
                        <script type="text/javascript">
                            VK.Widgets.Comments("vk_comments", {limit: 5, width: "665", attach: "*"});
                        </script>
                    </div>
                    <div class="group_vidget">

                    </div>
                </div>
               <?php echo get_upcoming_other_event($mon,$post->ID);?>
                <div class="postIdEvents" post-id="<?=$post->ID;?>"></div>
            </div>
        </div>



    </section>
<?php endwhile; // Кoнeц циклa ?>


<?php get_footer(); // Пoдключaeм футeр ?>