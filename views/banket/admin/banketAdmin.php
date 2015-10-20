<div class="col-lg-12">
    <div class="row">
        <h1>Банкеты и корпоративы</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Главное видео</h3>

            <div class="input-group">
                <!--главное видео-->
                <input type="text" class="form-control" placeholder="Embed link for youtube video" name="main-video"
                       value="<?= $video['video'] ?>">
                <span class="input-group-btn">
                    <button class="btn btn-success save-banket-video" type="button">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Наши залы</h3>

            <div class="panel-group" id="hallaccordion" role="tablist" aria-multiselectable="true">
                <?= do_shortcode('[hallAdmin]') ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Программы</h3>

            <div class="panel-group" id="programaccordion" role="tablist" aria-multiselectable="true">
                <?= do_shortcode('[programAdmin]') ?>
            </div>
        </div>
    </div>
</div>