
<footer class="footer">
    <div class="footer__partners">
        <div class="fotorama" data-width="160" data-height="60" data-nav="false" data-arrows="false" data-loop="true" data-autoplay="3000">
            <?= do_shortcode('[partners]');?>
        </div>
        <p>Наши<br>партнеры</p>
    </div>
    <?php
    $rrr = get_post_type( $post->ID );
    //echo $rrr;
        if((is_page('magazin')) || ($rrr === 'event') ){
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
    <form>
        <p>Как вас зовут?
            <br /><input type="text" name="name" id="nameFeedback" required/></p>
        <p>Ваш e-mail
            <br /><input type="email" name="email" id="emailFeedback" required/></p>
        <p>Номер телефона для обратной связи
            <br /><input type="text" name="telephone" id="telephoneFeedback" required/></p>
        <input type="button" class="feedback-button" name="" id="buttonFeedback" value="Отправить"/>
    </form>
    <!-- Тут любoе сoдержимoе -->
</div>
<div id="overlay"></div><!-- Пoдлoжкa -->
<div id="modal_form" class="doneEmailForm"><!-- Сaмo oкнo -->
    <span id="modal_close" class="closeEmailForm"><i class="fa fa-times"></i></span> <!-- Кнoпкa зaкрыть -->
    <h4>ДЛЯ ЗАВЕРШЕНИЯ РЕГИСТРАЦИИ ПОЖАЛАЙСТА, УКАЖИТЕ ВАШ E-MAIL</h4>
    <div>
        <p><input type="text" name="done-email" class="done-email" placeholder="Заполните поле и нажмите отправить"/></p>
        <a class="done-email-button">Отправить</a>
    </div>
    <!-- Тут любoе сoдержимoе -->
</div>
<?php wp_footer(); ?>
<script type="text/javascript">
    addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
    var ajaxurl = '/wp-admin/admin-ajax.php',
        pagenow = 'toplevel_page_mainpage',
        typenow = '',
        adminpage = 'toplevel_page_mainpage',
        thousandsSeparator = ' ',
        decimalPoint = ',',
        isRtl = 0;
</script>


</body>
</html>