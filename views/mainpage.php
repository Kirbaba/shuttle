<div class="container">
    <div class="col-lg-12">
        <p><h1>Выберите шаблон главного блока</h1></p>
        <p>Сейчас главный блок: <span class="current-num"></span></p>
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li role="presentation" class="active">
                <a href="#first" aria-controls="first" role="tab" data-toggle="tab">
                    <img class="type-img" src="{template_url}/img/type1.png" alt="">
                </a>
            </li>
            <li role="presentation" >
                <a href="#second" aria-controls="second" role="tab" data-toggle="tab">
                    <img class="type-img" src="{template_url}/img/type2.png" alt="">
                </a>
            </li>
            <li role="presentation" >
                <a href="#third" aria-controls="third" role="tab" data-toggle="tab">
                    <img class="type-img" src="{template_url}/img/type3.png" alt="">
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="first">
                <div class="col-lg-12">
                    <div class="slide-banner-section">
                        <h4 class="pink"> Крупный баннер (слайдер)</h4>

                        {slides}
                        <!-- Убрать -->
<!--                        <div class="col-lg-12 slide">-->
<!--                            <p>-->
<!--                                <input type="text" placeholder="Ссылка на событие" name="slide-link" class="slide-link">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-info media-upload">Выбрать изображение</button>-->
<!--                                <img src="" alt="" class="media">-->
<!--                                <input type="hidden" class="media-img" name="slide-img">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-success save-slide">Сохранить слайд</button>-->
<!--                                <button class="btn btn-warning add-slide">Добавить слайд</button>-->
<!--                            </p>-->
<!--                        </div>-->
                        <!-- /Убрать -->
                    </div>
                    <div class="top-banner-section">
                        <h4 class="fiolet"> Верхний баннер </h4>

                        {top}
                        <!-- Убрать -->
<!--                        <div class="col-lg-12 top-banner">-->
<!--                            <p>-->
<!--                                <input type="text" placeholder="Ссылка на событие" name="top-banner-link">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-info media-upload">Выбрать изображение</button>-->
<!--                                <img src="" alt="" class="media">-->
<!--                                <input type="hidden" name="top-banner-img" class="media-img">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-success save-top-banner">Сохранить</button>-->
<!--                            </p>-->
<!--                        </div>-->
                        <!-- /Убрать -->
                    </div>
                    <div class="bot-banner-section">
                        <h4 class="whitegray"> Нижний баннер </h4>

                        {bot}

<!--                        <div class="col-lg-12 bot-banner">-->
<!--                            <p>-->
<!--                                <input type="text" placeholder="Ссылка на событие" name="bot-banner-link">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-info media-upload">Выбрать изображение</button>-->
<!--                                <img src="" alt="" class="media">-->
<!--                                <input type="hidden" class="media-img" name="bot-banner-img">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-success save-bot-banner">Сохранить</button>-->
<!--                            </p>-->
<!--                        </div>-->
                    </div>
                    <p>
                        <button type="button" class="btn btn-primary choose-main" data-value="1">Выбрать главным</button>
                    </p>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="second">
                <div class="col-lg-12">
                    <div class="left-banner-section">
                        <h4 class="pink"> Левый баннер </h4>

                        {left}
<!--                        <div class="col-lg-12 left-banner">-->
<!--                            <p>-->
<!--                                <input type="text" placeholder="Ссылка на событие" name="left-banner-link">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-info media-upload">Выбрать изображение</button>-->
<!--                                <img src="" alt="" class="media">-->
<!--                                <input type="hidden" class="media-img" name="left-banner-img">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-success save-left-banner">Сохранить</button>-->
<!--                            </p>-->
<!--                        </div>-->
                    </div>
                    <div class="right-banner-section">
                        <h4 class="aqua">Правый баннер </h4>
                        {right}

<!--                        <div class="col-lg-12 right-banner">-->
<!--                            <p>-->
<!--                                <input type="text" placeholder="Ссылка на событие" name="right-banner-link">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-info media-upload">Выбрать изображение</button>-->
<!--                                <img src="" alt="" class="media">-->
<!--                                <input type="hidden" class="media-img" name="right-banner-img">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-success save-right-banner">Сохранить</button>-->
<!--                            </p>-->
<!--                        </div>-->
                    </div>

                    <p>
                        <button type="button" class="btn btn-primary choose-main" data-value="2">Выбрать главным</button>
                    </p>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="third">
                <div class="col-lg-12">
                    <div class="big-banner-section">
                        <h4 class="pink"> Баннер </h4>
                        {big}
<!--                        <div class="col-lg-12 big-banner">-->
<!--                            <p>-->
<!--                                <input type="text" placeholder="Ссылка на событие" name="big-banner-link">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-info media-upload">Выбрать изображение</button>-->
<!--                                <img src="" alt="" class="media">-->
<!--                                <input type="hidden" class="media-img" name="big-banner-img">-->
<!--                            </p>-->
<!---->
<!--                            <p>-->
<!--                                <button class="btn btn-success save-big-banner">Сохранить</button>-->
<!--                            </p>-->
<!--                        </div>-->
                    </div>
                    <p>
                        <button type="button" class="btn btn-primary choose-main" data-value="3">Выбрать главным</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
