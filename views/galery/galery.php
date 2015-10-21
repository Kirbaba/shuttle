
<div>
    <script type="text/javascript">
        hs.graphicsDir = 'highslide/graphics/';
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
    </script>
<?php
$link = $result['link'][0]->path;
$i = 0;
foreach($result['img'] as $img){
    ?>
    <a class="highslide" onclick="return hs.expand(this)" href="<?=$link?>/<?=$result['img'][$i]->filename?>"> <img src="<?=$link?>/<?=$result['img'][$i]->filename?>" alt="" width="100px"/></a>
<?php
    $i++;
}

?>
</div>