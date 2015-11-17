

<?php
get_header(); // Пoдключaeм хeдeр?>

<?php
    if(isset($_GET['photoreport'])){
        $photoreport = 'activeTab';
        $description = '';
        $photoBlock = 'active';
        $descBlock = '';
    }else{
        $photoreport = '';
        $description = 'activeTab';
        $photoBlock = '';
        $descBlock = 'active';
    }
?>
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
            <div class="events-page__head--navline">
                <h2><?php the_title(); ?></h2>
                <h5><?=$number?> <?=name_mon($mon)?></h5>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#description" class="events-page__head--but <?=$description?> "  data-toggle="tab">Описание</a></li>

                <?php
                    $photo = new Photo_report();
                    $k = $photo->get_empty_report($post->ID);
                    if($k == 1){
                        ?>
                        <li><a href="#fotoreport" class="events-page__head--but <?=$photoreport;?>" id="photoreportEvent"  data-toggle="tab">Фотоотчет</a></li>

                        <?
                    }
                ?>
                </ul>
            </div>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane <?=$descBlock?>" id="description">
                <div class="events-page__box">

                    <?=$post->post_content;?>

                </div>
                <?php
              upcoming_events($mon,$post->ID);
                echo get_parent($post->ID);
                ?>
            </div>

            <div class="tab-pane <?=$photoBlock?>" id="fotoreport">
               <?php show_report($post->ID);?>
                <div class="coments_wr">
                    <div class="coments">
                       /*Скрипт ВК отзывы*/
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