<?php foreach($hall as $item) { ?>
    <div class="wedding__box--item">
        <h4><?= $item['title'] ?></h4>
        <div class="wedding__box--item--img">
            <?php foreach($folio[$item['id']] as $folioitem){ ?>
                <img src="<?= $folioitem['img'] ?>" alt="">
            <?php } ?>
        </div>
        <p><?= $item['description'] ?></p>
        <h4><?= $item['people'] ?> человек</h4>
    </div>
<?php } ?>