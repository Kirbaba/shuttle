<?php
get_header(); // Пoдключaeм хeдeр?>





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
            <div class="breadcrumbs">
                <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
                <div class="likely likely-light">
                    <div class="facebook">Поделиться</div>
                    <div class="vkontakte">Поделиться</div>
                </div>
            </div>
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
                    <div class="events-page__info">
                        <div class="events-page__info--left">
                            <?=get_the_post_thumbnail($post->ID);?>
                            <div class="events-page__info--cocktail">
                                <h4 class="white">Коктейль в подарок</h4>
                                <p>За фото и хэштэг <i>#shuttlenightclub</i> в instagram</p>
                                <p>За вступление в <a href="#">группу вконтакте</a> и фотографию в ленту группы</p>
                                <p>За вступление в <a href="#">группу фейсбука</a> и фотографию в ленту группы</p>
                                <p></p>
                            </div>
                            <div class="events-page__info--contacts white">
                                <h3>Телефоны для справок:</h3>
                                <p><?php echo get_theme_mod('phone_textbox'); ?></p>
                            </div>
                        </div>
                        <div class="events-page__info--right">
                            <h2><?=$number?> <?=name_mon($mon)?>, <?=get_day_week($dateish);?></h2>
                            <?=$post->post_content;?>
                            <h3>Line up</h3>
                            <div class="events-page--lineup">
                                <?php
                                $artist = get_post_meta($post->ID, 'all_artist', TRUE);
                                $artist = json_decode($artist);
                                foreach($artist as $v){
                                    ?>
                                    <p><?=$v?></p>
                                <?php
                                }
                                ?>
                            </div>
                            <!--<div class="events-page--lineup--gogo">
                                <p><span>S|N|C GO-GO:</span> Cosmo Dance</p>
                            </div>-->

                            <h3>Services</h3>
                            <div class="events-page--services">
                                <p>WI-FI</p>
                                <p>Cocktail Set</p>
                                <p>Кальян(Atlantis)</p>
                                <p>FREE Cocktails for VIP Card</p>
                                <p>VIP Lodge</p>
                            </div>
                            <h3>Условия входа</h3>
                            <div class="events-page--enter">
                                <ul>
                                    <?php
                                    $circs_entry = get_post_meta($post->ID, 'circs_entry', TRUE);
                                    $circs_entry = json_decode($circs_entry);
                                    foreach($circs_entry as $key=>$value){
                                        ?>
                                        <li><p><?=$key;?></p><span class="free"><?=$value;?></span></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $upcoming_event = upcoming_events($mon,$post->ID);
                echo $upcoming_event;
                ?>
                <div class="events-page__partners">
                    <h1 class="blockTitle">Партнеры мероприятия</h1>
                    <div class="events-page__partners--item">
                        <img src="img/2gis-Logo.png" alt="">
                    </div>
                    <div class="events-page__partners--item">
                        <img src="img/2gis-Logo.png" alt="">
                    </div>
                    <div class="events-page__partners--item">
                        <img src="img/2gis-Logo.png" alt="">
                    </div>
                    <div class="events-page__partners--item">
                        <img src="img/2gis-Logo.png" alt="">
                    </div>
                    <div class="events-page__partners--item">
                        <img src="img/2gis-Logo.png" alt="">
                    </div>
                    <div class="events-page__partners--item">
                        <img src="img/2gis-Logo.png" alt="">
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="fotoreport">
               <?php show_report($post->ID);?>
            </div>
        </div>



    </section>
<?php endwhile; // Кoнeц циклa ?>


<?php get_footer(); // Пoдключaeм футeр ?>