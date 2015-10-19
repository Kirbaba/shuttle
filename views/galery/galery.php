<div>
<?php
$link = $result['link'][0]->path;
$i = 0;
foreach($result['img'] as $img){
    ?>
    <img src="<?=$link?>/<?=$result['img'][$i]->filename?>" alt="" width="100px"/>
<?php
    $i++;
}

?>
</div>