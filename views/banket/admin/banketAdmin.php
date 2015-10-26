<div class="col-lg-12">
    <div class="row">
        <h1>Банкеты и корпоративы</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Главное видео</h3>

            <div>
                <video src="<?= $video['video'] ?>" controls="controls" class="media main-video"></video>
                <button class="btn btn-info media-upload"><span
                        class="glyphicon glyphicon-picture"> Выбрать видео</span></button>
                <input type="hidden" class="media-img" name="main-video" value="<?= $video['video'] ?>">

                <button class="btn btn-success save-banket-video"><span class="glyphicon glyphicon-floppy-disk"></span>
                </button>
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