
<footer class="footer">
    <div class="footer__partners">
        <div class="fotorama" data-width="160" data-height="60" data-nav="false" data-arrows="false" data-loop="true">
            <?= do_shortcode('[partners]');?>
        </div>
        <p>Наши<br>партнеры</p>
    </div>
    <?php
        if(is_page('magazin')){
    ?>
            <div class="footer__button--contacts">
                <p><?php echo get_theme_mod('phone_textbox'); ?></p>
                <a href="mailto:<?php echo get_theme_mod('mail_textbox'); ?>"><?php echo get_theme_mod('mail_textbox'); ?></a>
            </div>
    <?
        }else{
    ?>
    <div class="footer__button">
        <a id="go" >ОБРАТНАЯ СВЯЗЬ</a>
    </div>
    <?php
        }
    ?>
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