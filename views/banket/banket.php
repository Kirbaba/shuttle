<section class="events-page">
    <div class="events-page__head">
        <div class="breadcrumbs">
            <a href="/main">Главная</a><p>/ Банкеты и опоративы</p>
        </div>
        <div class="events-page__head--navline">
            <h2>Банкеты и копоративы</h2>
        </div>
    </div>
    <section class="wedding">
        <div class="wedding__video">
            <video width="100%" height="100%" controls>
                <source src="<?= $video['video'] ?>">
            </video>

<!--            <iframe width="100%" height="100%" src="--><?//= $video['video'] ?><!--" frameborder="0" allowfullscreen></iframe>-->
        </div>
        <div class="wedding__box">
            <h2><span>Наши залы</span></h2>
            <?= $halls ?>

            <h2><span>Программы</span></h2>
            <?= $programs ?>

        </div>
        <div style="padding: 25px">


        <?= do_shortcode("[gal id='4']")?></div>
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


    </section>
</section>