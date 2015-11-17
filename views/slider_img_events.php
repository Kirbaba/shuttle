<div class="wrapper">
    <div class="slick-codepen">
        <?php
        foreach ($result['img'] as $img) {
            $size = getimagesize($img->images);
            //prn($size);
            ?>
            <div style="position:relative;">
                <div class="slide__img_box">

                    <?php
                        if($size[0] > $size[1]){
                            echo "<img src='$img->images' style='margin-top:150px;'/>";
                        }
                    else{
                        echo "<img src='$img->images'/>";
                    }
                    ?>

                </div>
                <div class="social_img_photo_report">
                    <div class="news__item--soc">
                        <?php
                        if ( is_user_logged_in() ) {
                            ?>
                            <a class="download_img" href="<?=$img->images; ?>" download >Скачать в HD</a>
                        <?php }
                        else{
                            ?>
                        <span class="text_download">Скачивание в HD доступно только авторизированным пользователям</span>
                        <?php
                        }
                        ?>
                        <a class="fb" href="http://www.facebook.com/sharer.php?u=<?= $img->images; ?>" target="_blank">Поделиться фотографией</a>
                        <a class="vk" href="http://vk.com/share.php?url=<?= $img->images; ?>" target="_blank">Поделиться фотографией</a>
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
            <div><img src="<?= $img->images; ?>"/></div>
        <?php
        }

        ?>
    </div>
</div>