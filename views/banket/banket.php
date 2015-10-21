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
            <iframe width="100%" height="100%" src="<?= $video['video'] ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="wedding__box">
            <h2><span>Наши залы</span></h2>
            <?= $halls ?>

            <h2><span>Программы</span></h2>
            <?= $programs ?>
        </div>
    </section>
</section>