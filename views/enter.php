<?php
/*
Template Name: Start
*/
?>
<!DOCTYPE html>
<html lang="en">
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
<section class="enter">
    <div class="contain">
        <div class="enter__container">
            <article class="logo">
                <a href="/main">
                    <img src="<?php echo get_theme_mod('logo_textbox'); ?>">
                </a>
            </article>
            <div class="enter__box">
                <?php echo getEnterBox(); ?>
            </div>
            <div class="enter__button">
                <a href="/main">Войти на сайт</a>
            </div>
        </div>
    </div>
</section>
</html>
