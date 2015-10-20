<?php
/*
Template Name: Банкет
*/

get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <?= do_shortcode('[banketIndex]')?>
        </div><!-- #content -->
    </div><!-- #primary -->

    <div id="modal_form"><!-- Сaмo oкнo -->
        <div id="orderProduct" nameProduct=""></div>
        <span id="modal_close"><i class="fa fa-times"></i></span> <!-- Кнoпкa зaкрыть -->
        <h4 class="titleorder">СДЕЛАТЬ ЗАКАЗ</h4>
        <form>
            <p>Введите ваше имя
                <br /><input type="text" name="name" id="nameOrder" required/></p>
            <p>Введите телефон для связи
                <br /><input type="text" name="telephone" id="telephoneOrder" required/></p>
            <p>Введите Email
                <br /><input type="email" name="email" id="emailOrder" required/></p>
            <input type="button" name="" id="buttomOrder" value="Сделать заказ"/>
        </form>
        <!-- Тут любoе сoдержимoе -->
    </div>
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
<?php get_footer(); ?>