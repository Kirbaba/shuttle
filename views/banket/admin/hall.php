<?php foreach ($hall as $item) { ?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headinghall<?= $item['id'] ?>">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#hallaccordion"
                   href="#collapsehall<?= $item['id'] ?>"
                   aria-expanded="true" aria-controls="collapsehall<?= $item['id'] ?>">
                    <?= $item['title'] ?>
                </a>
            </h4>
        </div>
        <div id="collapsehall<?= $item['id'] ?>" class="panel-collapse collapse in" role="tabpanel"
             aria-labelledby="headinghall<?= $item['id'] ?>">
            <div class="panel-body">
                <div class="row">
                    <div class="input-group">
                        <!--название зала-->
                        <input type="text" class="form-control" placeholder="Название зала" name="hall-name"
                               value="<?= $item['title'] ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-success save-hall-name" type="button" data-num="<?= $item['id'] ?>"><span
                                class="glyphicon glyphicon-floppy-disk"></span></button>
                    </span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <!--описание зала-->
                        <input type="text" class="form-control" placeholder="Описание зала" name="hall-description"
                               value="<?= $item['description'] ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-success save-hall-description" type="button"
                                data-num="<?= $item['id'] ?>"><span class="glyphicon glyphicon-floppy-disk"></span>
                        </button>
                    </span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <!--количество человек-->
                        <input type="text" class="form-control" placeholder="Количество человек" name="hall-people"
                               value="<?= $item['people'] ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-success save-hall-people" type="button" data-num="<?= $item['id'] ?>">
                            <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    </span>
                    </div>
                </div>
                <div class="row">
                    <ul class="list-group hall-folio-list" data-hall="<?= $item['id'] ?>">
                        <?= $hallfolio[$item['id']]; ?>
                    </ul>
                    <button class="btn btn-warning pull-right add-folio-item" data-hall="<?= $item['id'] ?>">Добавить
                        изображение
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>