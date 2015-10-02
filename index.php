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
            <?php wp_nav_menu( array( 'theme_location' => 'header_menu','container' => 'nav', 'container_class' => 'navigation') );?>
<!--            <nav class="navigation">-->
<!--                <ul>-->
<!--                    <li><a href="#nowhere" class="active">Главная</a></li>-->
<!--                    <li><a href="#nowhere">события</a></li>-->
<!--                    <li><a href="#nowhere">Фото и видео</a></li>-->
<!--                    <li><a href="#nowhere">СТОЛ НАХОДОК</a></li>-->
<!--                    <li><a href="#nowhere">О клубе</a></li>-->
<!--                    <li><a href="#nowhere">Магазин</a></li>-->
<!--                    <li><a href="#nowhere">Контакты</a></li>-->
<!--                    <li><a href="#nowhere">ДОСКА ПОЧЕТА</a></li>-->
<!--                </ul>-->
<!--            </nav>-->
            <article class="logo">
                <a href="#nowhere">
                    <img src="<?php bloginfo('template_directory'); ?>/img/logo.png">
                </a>
            </article>
            <div class="header__rightside">
                <div class="header__rightside--enter" onclick="VK.Auth.login(onSignon)">
                    <a>АВТОРИЗИРУЙТЕСЬ ЧЕРЕЗ <i class="fa fa-vk"></i></a>
                </div>
                <div class="header__rightside--contacts">
                    <p><?php echo get_theme_mod('phone_textbox'); ?></p>
                    <a href="mailto:<?php echo get_theme_mod('mail_textbox'); ?>"><?php echo get_theme_mod('mail_textbox'); ?></a>
                </div>
            </div>
        </header>
        <section class="home">
            <?php echo getEnterBox(); ?>
            <div class="home__calendar">
                <img src="<?php bloginfo('template_directory'); ?>/img/calendar.png">
            </div>
        </section>
        <footer class="footer">
            <div class="footer__partners">
                <div class="fotorama" data-width="160" data-height="60" data-nav="false" data-arrows="false" data-loop="true">
                    <?= do_shortcode('[partners]');?>
                </div>
                <p>Наши<br>партнеры</p>
            </div>
            <div class="footer__button">
                <a id="go" >ОБРАТНАЯ СВЯЗЬ</a>
            </div>
            <div class="footer__soc">
                <div class="footer__soc--box">
                    <a href="<?php echo get_theme_mod('vk_textbox'); ?>"><i class="fa fa-circle fa-vk"></i></a>
                    <a href="<?php echo get_theme_mod('insta_textbox'); ?>"><i class="fa fa-circle fa-instagram"></i></a>
                    <a href="<?php echo get_theme_mod('fb_textbox'); ?>"><i class="fa fa-facebook"></i></a>
                </div>
            </div>
        </footer>
    </div>
</div>
<div id="modal_form"><!-- Сaмo oкнo -->
    <span id="modal_close"><i class="fa fa-times"></i></span> <!-- Кнoпкa зaкрыть -->
    <h4>ОБРАТНАЯ СВЯЗЬ</h4>
    <p>Если вы хотите забронировать столик, у вас есть вопросы или предлождения, то укажите свое имя, e-mail или номер телефона. Наш сотрудник обязательно свяжется с вами в ближайшее время.  Вы также можете оставить заявку по телефону: <span class="modal_phone"> 24-20-20</span></p>
    <!-- Тут любoе сoдержимoе -->
</div>
<div id="overlay"></div><!-- Пoдлoжкa -->
<?php wp_footer(); ?>
</body>
</html>