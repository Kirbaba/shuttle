<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?=$ID?>">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$ID?>" aria-expanded="true" aria-controls="collapse<?=$ID?>">
                <?= $name;?>
                <a class="pull-right" href="/wp-admin/admin.php?page=photo_report&action=delit&id=<?=$ID?>">Удалить</a>
            </a>
        </h4>
    </div>
    <div id="collapse<?= $ID ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?=$ID?>">
        <div class="panel-body">
           <?php foreach($video as $item){ ?>
               <div class='photo_report_vid_wr'>
                   <video src='<?= $item->video; ?>' width='320' height='240' preload></video>
                   <input type='hidden' name='kv_multiple_attachments_vid[]' id='' value='<?= $item->video; ?>'/>
                   <span class='dell'>x</span>
               </div>
           <?php } ?>
        </div>
    </div>
</div>