<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php wp_title(''); ?></title>

<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css">-->
<!--    <link rel="stylesheet" href="--><?php //echo get_template_directory_uri(); ?><!--/css/style.css">-->
<!--    <link rel="stylesheet" href="--><?php //echo get_template_directory_uri(); ?><!--/sass/style.css">-->
<!--    <link href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">-->
    <?php wp_head();?>
    <script type="text/javascript">
        hs.graphicsDir = '<?=get_template_directory_uri();?>/highslide/graphics/';
        hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.wrapperClassName = 'dark borderless floating-caption';
        hs.fadeInOut = true;
        hs.dimmingOpacity = .75;
        hs.showCredits = false;

        // Add the controlbar
        if (hs.addSlideshow) hs.addSlideshow({
            //slideshowGroup: 'group1',
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: 'fit',
            overlayOptions: {
                opacity: .6,
                position: 'bottom center',
                hideOnMouseOut: true
            }
        });
    </script>
</head>
<body>
<div class="bg_masck index_margintop">
<div class="contain">
    <header class="header">
        <?php wp_nav_menu( array( 'theme_location' => 'header_menu','container' => 'nav', 'container_class' => 'navigation') );?>
        <article class="logo">
             <a href="/main">
                <img src="<?php echo get_theme_mod('logo_textbox'); ?>">
             </a>
        </article>
        <div class="header__rightside">
            <?php if(is_user_logged_in()){
                $current_user = wp_get_current_user();
                ?>
                <div class="header__rightside--enter" >
                    <?= get_avatar($current_user->ID) ?>
                    <p><?= $current_user->user_firstname.'<br />'.$current_user->user_lastname ?></p>
                </div>
            <?php }else{?>
                <div class="header__rightside--enter" onclick="VK.Auth.login(onSignon)">
                    <a>АВТОРИЗИРУЙТЕСЬ <br />ЧЕРЕЗ <i class="fa fa-vk"></i></a>
                </div>
            <?php } ?>

            <div class="header__rightside--contacts">
                <p><?php echo get_theme_mod('phone_textbox'); ?></p>
                <a href="mailto:<?php echo get_theme_mod('mail_textbox'); ?>"><?php echo get_theme_mod('mail_textbox'); ?></a>
            </div>
        </div>
<!--        <div class="header__rightside">-->
<!--            <div class="header__rightside--enter">-->
<!--                <a href="#nowhere">Войдите</a>-->
<!---->
<!--                <p>или</p><a href="#" class="reg">ЗАРЕГИСТРИРУЙТЕСЬ</a>-->
<!--            </div>-->
<!--            <div class="header__rightside--contacts">-->
<!--                <p>+7 (3532) 24-20-20, 24-55-44</p>-->
<!--                <a href="mailto:Shuttleclub@yandex.ru">Shuttleclub@yandex.ru</a>-->
<!--            </div>-->
<!--        </div>-->
    </header>