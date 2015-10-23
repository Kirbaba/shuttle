
<div>

<?php
$link = $result['link'][0]->path;
$i = 0;

foreach($result['img'] as $img){
    ?>
    <a class="highslide" onclick="return hs.expand(this)"
       href="<?php echo get_home_url().'/'.$link.'/'.$result['img'][$i]->filename?>">
        <img src="<?php echo get_home_url().'/'.$link.'/thumbs/thumbs_'.$result['img'][$i]->filename?>" alt="" width="166px"/></a>
<?php
    $i++;
}

?>
</div>