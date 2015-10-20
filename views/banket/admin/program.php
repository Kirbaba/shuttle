<?php foreach($program as $item){ ?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingprogram<?= $item['id'] ?>">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#programaccordion" href="#collapseprogram<?= $item['id'] ?>" aria-expanded="true" aria-controls="collapseprogram<?= $item['id'] ?>">
                    <?= $item['title'] ?>
                </a>
            </h4>
        </div>
        <div id="collapseprogram<?= $item['id'] ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingprogram<?= $item['id'] ?>">
            <div class="panel-body">
                <div class="row">
                    <div class="input-group">
                        <!--название программы-->
                        <input type="text" class="form-control" placeholder="Название программы" name="program-name" value="<?= $item['title'] ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-success save-program-name" type="button" data-num="<?= $item['id'] ?>"><span class="glyphicon glyphicon-floppy-disk"></span></button>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <!--описание программы-->
                        <input type="text" class="form-control" placeholder="Описание программы" name="program-description" value="<?= $item['description'] ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-success save-program-description" type="button" data-num="<?= $item['id'] ?>"><span class="glyphicon glyphicon-floppy-disk"></span></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>