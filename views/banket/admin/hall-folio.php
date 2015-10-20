<?php foreach($folio as $item){ ?>
    <li class="list-group-item" data-num="<?= $item['id'] ?>">
        <div class="row">
            <div class="col-lg-6">
                <img src="<?= $item['img'] ?>" alt="" class="hall-folio-img media">
                <button class="btn btn-info media-upload"><span class="glyphicon glyphicon-picture"> Выбрать изображение</span></button>
                <input type="hidden" class="media-img" name="hall-folio-img" value="<?= $item['img'] ?>">
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success save-hall-folio"><span class="glyphicon glyphicon-floppy-disk"></span></button>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-danger del-hall-folio" data-num="<?= $item['id'] ?>"><span class="glyphicon glyphicon-trash"></span></button>
            </div>
        </div>
    </li>
<?php } ?>