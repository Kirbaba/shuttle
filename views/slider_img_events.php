<div class="wrapper">
    <div class="slick-codepen">
        <?php
        foreach ($result['img'] as $img) {

            ?>
            <div style="position:relative;">
                <div class="slide__img_box">
                    <img src="<?= $result['link']; ?>/img_events/<?= $img->images; ?>"/>
                </div>
                <div class="social_img_photo_report">
                    <div class="news__item--soc">
                        <?php
                        if ( is_user_logged_in() ) {
                            ?>
                            <a href="<?= $result['link']; ?>/img_events/<?= $img->images; ?>" download >Скачать в HD</a>
                        <?php }
                        ?>
                        <a href="http://www.facebook.com/sharer.php?u=<?= $result['link']; ?>/img_events/<?= $img->images; ?>" target="_blank"><i class="fa fa-facebook"></i>Поделиться фотографией</a>
                        <a href="http://vk.com/share.php?url=<?= $result['link']; ?>/img_events/<?= $img->images; ?>" target="_blank"><i class="fa fa-vk"></i>Поделиться фотографией</a>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>

    <div class="slider-nav">
        <?php
        foreach ($result['img'] as $img) {
            ?>
            <div><img src="<?= $result['link']; ?>/img_events/<?= $img->images; ?>"/></div>
        <?php
        }

        ?>
    </div>
</div>