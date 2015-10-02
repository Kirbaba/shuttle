<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php wp_title(''); ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/sass/style.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
</head>
<body>


<div class="contain">
    <header class="header">
        <nav class="navigation">
            <ul>
                <li><a href="#nowhere">Главная</a></li>
                <li><a href="#nowhere">события</a></li>
                <li><a href="#nowhere">Фото и видео</a></li>
                <li><a href="#nowhere">СТОЛ НАХОДОК</a></li>
                <li><a href="#nowhere">О клубе</a></li>
                <li><a href="#nowhere" class="active">Магазин</a></li>
                <li><a href="#nowhere">Контакты</a></li>
                <li><a href="#nowhere">ДОСКА ПОЧЕТА</a></li>
            </ul>
        </nav>
        <article class="logo">
            <a href="#nowhere">
                <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png">
            </a>
        </article>
        <div class="header__rightside">
            <div class="header__rightside--enter">
                <a href="#nowhere">Войдите</a>

                <p>или</p><a href="#" class="reg">ЗАРЕГИСТРИРУЙТЕСЬ</a>
            </div>
            <div class="header__rightside--contacts">
                <p>+7 (3532) 24-20-20, 24-55-44</p>
                <a href="mailto:Shuttleclub@yandex.ru">Shuttleclub@yandex.ru</a>
            </div>
        </div>
    </header>