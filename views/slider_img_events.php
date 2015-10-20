<?php
   // prn($result);
?>
<div class="slider-for">
    <?php
    foreach ($result['img'] as $img) {

        ?>
        <div><img src="<?=$result['link'];?>/img_events/<?=$img->images;?>"/></div>
    <?php
    }
    ?>
</div>
<div class="slider-nav">
    <?php
    foreach ($result['img'] as $img) {

        ?>
        <div><img src="<?=$result['link'];?>/img_events/<?=$img->images;?>"/></div>
    <?php
    }
    ?>
</div>