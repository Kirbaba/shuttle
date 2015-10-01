<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="icon" href="/wp-content/uploads/2015/03/657068.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/wp-content/uploads/2015/03/657068.ico" type="image/x-icon" />
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaOWKyamSxMTXclSDFmJ2N4Am20PCTD6I&sensor=FALSE">
    </script>
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body>
<div class="bg_masck index_margintop">
    <div class="contain">
        <header class="header">
            <nav class="navigation">
                <ul>
                    <li><a href="#nowhere" class="active">Главная</a></li>
                    <li><a href="#nowhere">события</a></li>
                    <li><a href="#nowhere">Фото и видео</a></li>
                    <li><a href="#nowhere">СТОЛ НАХОДОК</a></li>
                    <li><a href="#nowhere">О клубе</a></li>
                    <li><a href="#nowhere">Магазин</a></li>
                    <li><a href="#nowhere">Контакты</a></li>
                    <li><a href="#nowhere">ДОСКА ПОЧЕТА</a></li>
                </ul>
            </nav>
            <article class="logo">
                <a href="#nowhere">
                    <img src="img/logo.png">
                </a>
            </article>
            <div class="header__rightside">
                <div class="header__rightside--enter">
                    <a href="#nowhere">АВТОРИЗИРУЙТЕСЬ ЧЕРЕЗ <i class="fa fa-vk"></i></a>
                </div>
                <div class="header__rightside--contacts">
                    <p>+7 (3532) 24-20-20, 24-55-44</p>
                    <a href="mailto:Shuttleclub@yandex.ru">Shuttleclub@yandex.ru</a>
                </div>
            </div>
        </header>
        <section class="home">
            <?php echo getEnterBox(); ?>
            <div class="home__calendar">
                <img src="img/calendar.png">
            </div>
        </section>
        <footer class="footer">
            <div class="footer__partners">
                <div class="fotorama" data-width="160" data-height="60" data-nav="false" data-arrows="false" data-loop="true">
                    <img src="img/Layer-44.png" alt="">
                    <img src="img/logo.png" alt="">
                </div>
                <p>Наши<br>партнеры</p>
            </div>
            <div class="footer__button">
                <a href="#nowhere">ОБРАТНАЯ СВЯЗЬ</a>
            </div>
            <div class="footer__soc">
                <div class="footer__soc--box">
                    <a href="#"><i class="fa fa-circle fa-vk"></i></a>
                    <a href="#"><i class="fa fa-circle fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                </div>
            </div>
        </footer>
    </div>
</div>}
?>
<?php wp_footer(); ?>
</body>
</html>