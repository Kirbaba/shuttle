<?php

if (!current_user_can('administrator')):
    show_admin_bar(false);
endif;

function add_style()
{
    // wp_enqueue_style( 'my-bootstrap-extension', get_template_directory_uri() . '/css/bootstrap.css', array(), '1');
    wp_enqueue_style('my-styles', get_template_directory_uri() . '/css/style.css', array(), '1');
    wp_enqueue_style('my-sass', get_template_directory_uri() . '/sass/style.css', array(), '1');
    wp_enqueue_style('fotorama-css', 'http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css', array(), '1');
    wp_enqueue_style('fa-style', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css', array(), '1');
    wp_enqueue_style('likely', get_template_directory_uri() . '/css/likely.css', array(), '1');
    wp_enqueue_style('highslide', get_template_directory_uri() . '/highslide/highslide.css', array(), '1');
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css', array(), '1');
    wp_enqueue_style('slick-theme', get_template_directory_uri() . '/css/slick-theme.css', array(), '1');

}

function add_script()
{
    //wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-2.1.3.min.js', array(), '1');
    wp_enqueue_script('likely', get_template_directory_uri() . '/js/likely.js', array(), '1');
    wp_enqueue_script('jq', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), '1');
    wp_enqueue_script('api-maps', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU', array(), '1');
    wp_enqueue_script( 'my-bootstrap-extension', get_template_directory_uri() . '/js/bootstrap.js', array(), '1');
    wp_enqueue_script('my-script', get_template_directory_uri() . '/js/script.js', array(), '1');
    wp_enqueue_script('fotorama-js', 'http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', array(), '1');
    wp_enqueue_script('plagins', get_template_directory_uri() . '/js/plugins.js', array(), '1');
    wp_enqueue_script('slymin', get_template_directory_uri() . '/js/sly.min.js', array(), '1');
    wp_enqueue_script('slymin', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1');
    wp_enqueue_script('highslide', get_template_directory_uri() . '/highslide/highslide-with-gallery.js', array(), '1');
    wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.js', array(), '1');
    wp_enqueue_script('placemark', get_template_directory_uri() . '/js/placemark.js', array(), '1');
   // wp_enqueue_script('highslide', get_template_directory_uri() . '/highslide/highslide-with-gallery.js', array(), '1');


}


add_action('wp_enqueue_scripts', 'add_style');
add_action('wp_enqueue_scripts', 'add_script');

function prn($content)
{
    echo '<pre style="background: lightgray; border: 1px solid black; padding: 2px">';
    print_r($content);
    echo '</pre>';
}

function my_pagenavi()
{
    global $wp_query;

    $big = 999999999; // уникальное число для замены

    $args = array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big))
    , 'format' => ''
    , 'current' => max(1, get_query_var('paged'))
    , 'total' => $wp_query->max_num_pages
    );

    $result = paginate_links($args);

    // удаляем добавку к пагинации для первой страницы
    $result = str_replace('/page/1/', '', $result);

    echo $result;
}

function excerpt_readmore($more)
{
    return '... <br><a href="' . get_permalink($post->ID) . '" class="readmore">' . 'Читать далее' . '</a>';
}

add_filter('excerpt_more', 'excerpt_readmore');


if (function_exists('add_theme_support'))
    add_theme_support('post-thumbnails');

/*-------------------------МАГАЗИН-------------------------------*/
add_action('init', 'my_custom_init');
function my_custom_init()
{
    $labels = array(
        'name' => 'Магазин', // Основное название типа записи
        'singular_name' => 'Товар', // отдельное название записи типа Book
        'add_new' => 'Добавить товар',
        'add_new_item' => 'Добавить новый товар',
        'edit_item' => 'Редактировать товар',
        'new_item' => 'Новый товар',
        'view_item' => 'Посмотреть товар',
        'search_items' => 'Найти товар',
        'not_found' => 'Товаров не найдено',
        'not_found_in_trash' => 'В корзине товаров не найдено',
        'parent_item_colon' => '',
        'menu_name' => 'Магазин'

    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail')
    );
    register_post_type('product', $args);
}

// Добавляем фильтр, который изменит сообщение при публикации при изменении типа записи Book
add_filter('post_updated_messages', 'product_updated_messages');
function product_updated_messages($messages)
{
    global $post, $post_ID;

    $messages['product'] = array(
        0 => '', // Не используется. Сообщения используются с индекса 1.
        1 => sprintf('Book обновлено. <a href="%s">Посмотреть запись book</a>', esc_url(get_permalink($post_ID))),
        2 => 'Произвольное поле обновлено.',
        3 => 'Произвольное поле удалено.',
        4 => 'Запись Book обновлена.',
        /* %s: дата и время ревизии */
        5 => isset($_GET['revision']) ? sprintf('Запись Book восстановлена из ревизии %s', wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6 => sprintf('Товар опубликован. <a href="%s">Перейти к продукту</a>', esc_url(get_permalink($post_ID))),
        7 => 'Запись Book сохранена.',
        8 => sprintf('Продукт сохранен. <a target="_blank" href="%s">Предпросмотр продукта</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf('Запись Book запланирована на: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр записи book</a>',
            // Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
            date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf('Черновик записи Book обновлен. <a target="_blank" href="%s">Предпросмотр записи book</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;
}

function my_extra_fields()
{
    add_meta_box('extra_fields', 'Цена', 'extra_fields_box_func', 'product', 'normal', 'high');
    add_meta_box('extra_fields', 'Дата', 'extra_fields_event_func', 'event', 'normal', 'high');
}

add_action('add_meta_boxes', 'my_extra_fields', 1);

function extra_fields_box_func($post)
{
    ?>
    <p><span>Введите только цифры.</span><input type="text" pattern="\d+(\.\d{2})?" name="extra[price]"
                                                value="<?php echo get_post_meta($post->ID, 'price', 1); ?>"
                                                style="width:50%"/></p>
<?php
}

add_action('save_post', 'my_extra_fields_update', 10, 1);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update($post_id)
{
    // Все ОК! Теперь, нужно сохранить/удалить данные
    //$_POST['extra'] = array_map('trim', $_POST['extra']); // чистим все данные от пробелов по краям
    /*foreach($_POST['extra']['artist'] as $v){

    }*/
    if (isset($_POST['extra'])) {
        $img = json_encode($_POST['extra']['attachment_url'],JSON_UNESCAPED_UNICODE);
        update_post_meta($post_id, 'images', $img);
        unset($_POST['extra']['attachment_url']);

        /*$artist = json_encode($_POST['extra']['artist'],JSON_UNESCAPED_UNICODE);
        update_post_meta($post_id, 'all_artist', $artist);
        unset($_POST['extra']['artist']);
        $circs_entry = array_combine($_POST['extra']['circs_entry_key'],$_POST['extra']['circs_entry_value']);
        $circs_entry = json_encode($circs_entry,JSON_UNESCAPED_UNICODE);
        update_post_meta($post_id, 'circs_entry', $circs_entry);
        unset($_POST['extra']['circs_entry_key']);
        unset($_POST['extra']['circs_entry_value']);*/

        foreach ($_POST['extra'] as $key => $value) {

            if (empty($value)) {
                delete_post_meta($post_id, $key); // удаляем поле если значение пустое
                continue;
            }

            update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
        }
        return $post_id;
    }
}

/*-------------------------КОНЕЦ МАГАЗИНА-------------------------------*/

/*------------------------СТРАНИЦА СОБЫТИЯ------------------------------*/
add_action('init', 'my_custom_init_event');
function my_custom_init_event()
{
    $labels = array(
        'name' => 'События', // Основное название типа записи
        'singular_name' => 'Событие', // отдельное название записи типа Book
        'add_new' => 'Добавить событие',
        'add_new_item' => 'Добавить новое событие',
        'edit_item' => 'Редактировать событие',
        'new_item' => 'Новое событие',
        'view_item' => 'Посмотреть событие',
        'search_items' => 'Найти событие',
        'not_found' => 'Событий не найдено',
        'not_found_in_trash' => 'В корзине событий не найдено',
        'parent_item_colon' => '',
        'menu_name' => 'События'

    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail','comments')
    );
    register_post_type('event', $args);
}

// Добавляем фильтр, который изменит сообщение при публикации при изменении типа записи Book
add_filter('post_updated_messages', 'product_updated_messages_event');
function product_updated_messages_event($messages)
{
    global $post, $post_ID;

    $messages['product'] = array(
        0 => '', // Не используется. Сообщения используются с индекса 1.
        1 => sprintf('Book обновлено. <a href="%s">Посмотреть запись book</a>', esc_url(get_permalink($post_ID))),
        2 => 'Произвольное поле обновлено.',
        3 => 'Произвольное поле удалено.',
        4 => 'Запись Book обновлена.',
        /* %s: дата и время ревизии */
        5 => isset($_GET['revision']) ? sprintf('Запись Book восстановлена из ревизии %s', wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6 => sprintf('Событие опубликовано. <a href="%s">Перейти к продукту</a>', esc_url(get_permalink($post_ID))),
        7 => 'Запись Book сохранена.',
        8 => sprintf('Событие сохранено. <a target="_blank" href="%s">Предпросмотр продукта</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf('Запись Book запланирована на: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр записи book</a>',
            // Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
            date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf('Черновик записи Book обновлен. <a target="_blank" href="%s">Предпросмотр записи book</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;
}

function extra_fields_event_func($post)
{
    ?>
    <!--<p><input type="text" name="extra[date]" value="<?php /*echo get_post_meta($post->ID, 'date', 1); */ ?>" style="width:50%" /></p>-->
    <input type="date" name="extra[date]" value="<?php echo get_post_meta($post->ID, 'date', 1); ?>" max="2200-12-31"
           min="2015-05-29">

<?php
}

function extra_fields_event_artist($post)
{
    $artist = get_post_meta($post->ID, 'all_artist', TRUE);
    $artist = json_decode($artist);
    if (empty($artist)) {
        ?>
        <input type="text" name="extra[artist][]" id="" value=""/><a href="#" id="delArtist">Del</a><br/>
        <input type="button" name="" id="add_artist" value="Добавить"/>
    <?php
    } else {
        foreach ($artist as $v) {
            ?>
            <input type="text" name="extra[artist][]" id="" value="<?= $v; ?>"/>
            <a href="#" id="delArtist">Del</a>
            <br/>

        <?php
        }
        ?>
        <input type="button" name="" id="add_artist" value="Добавить"/>
    <?php
    }
    //prn($artist);
    ?>


<?php
}

function artist_extra_field_event()
{
    //add_meta_box('extra_fields_artist', 'Исполнители', 'extra_fields_event_artist', 'event', 'normal', 'high');
}

add_action('add_meta_boxes', 'artist_extra_field_event', 5);

function circs_entry_extra_field_event(){
   // add_meta_box('extra_fields_circs_entry', 'Условия входа', 'extra_field_event_circs_entry', 'event', 'normal', 'high');
}



add_action('add_meta_boxes', 'circs_entry_extra_field_event', 2);


function extra_field_event_circs_entry($post){
    $circs_entry = get_post_meta($post->ID, 'circs_entry', TRUE);
    $circs_entry = json_decode($circs_entry);
    if(empty($circs_entry)){
    ?>
            <p>Название условия: <input type="text" name="extra[circs_entry_key][]" id="" value=""/>
                Условие: <input type="text" name="extra[circs_entry_value][]" id="" value=""/>
                <a href="#" id="del_circs_entry">Del</a></p><br/>
            <input type="button" name="" id="add_circs_entry" value="Добавить"/>
            <?php
        }
        else{
            foreach($circs_entry as $key=>$value){?>
                <p>Название условия: <input type="text" name="extra[circs_entry_key][]" id="" value="<?=$key;?>"/>
                Условие: <input type="text" name="extra[circs_entry_value][]" id="" value="<?=$value;?>"/>
                <a href="#" id="del_circs_entry">Del</a></p><br/>
          <?php  } ?>
            <input type="button" name="" id="add_circs_entry" value="Добавить"/>
       <?php }
    ?>


<?php
}

function extraFieldsGallery($post)
{
    $galleries = getDataFromDb('wp_ngg_gallery');
    $curGallery = get_post_meta($post->ID, "gallery", 1);
    ?>
    <p>
        <span>Выберите галерею: </span>
        <select name="extra[gallery]">
        <?php
            foreach($galleries as $gallery){
                if($curGallery == $gallery['gid']){
                    echo "<option selected value='".$gallery['gid']."'>".$gallery['title']."</option>";
                }else{
                    echo "<option value='".$gallery['gid']."'>".$gallery['title']."</option>";
                }
            }
        ?>
        </select>
    </p>
    <?php
}

function myExtraFieldsGallery()
{
    add_meta_box('extra_gallery', 'Галерея', 'extraFieldsGallery', 'event', 'normal', 'high');
}

add_action('add_meta_boxes', 'myExtraFieldsGallery', 1);
/*-------------------- КОНЕЦ СТРАНИЦА СОБЫТИЯ---------------------------*/

define('TM_DIR', get_template_directory(__FILE__));
define('TM_URL', get_template_directory_uri(__FILE__));

require_once TM_DIR . '/parser.php';
require_once TM_DIR . '/breadcrumbs.php';
require_once TM_DIR . '/lib/Photo_report.php';
require_once TM_DIR . '/lib/Parent_events.php';

//Стили для админки
function add_admin_style()
{
    wp_enqueue_style('my-bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css', array(), '1');
    wp_enqueue_style('my-admin-style', get_template_directory_uri() . '/css/admin_style.css', array(), '1');
    wp_enqueue_script('jq', get_template_directory_uri() . '/js/jquery-2.1.4.min.js', array(), '1');
    wp_enqueue_script('my-bootstrap-script', get_template_directory_uri() . '/js/bootstrap.js', array(), '1');
    wp_enqueue_script('my-admin-script', get_template_directory_uri() . '/js/admin.js', array(), '1');
}

add_action('admin_enqueue_scripts', 'add_admin_style');

function admin_menu()
{
    add_menu_page('Настройка главного блока', 'Главный блок', 'manage_options', 'mainpage', 'mainpage');
    add_menu_page('Настройка партнеров', 'Наши партнеры', 'manage_options', 'partners', 'partners');
    add_menu_page('Настройка банкета', 'Банкеты', 'manage_options', 'banket', 'banketAdmin');
}

add_action('admin_menu', 'admin_menu');

/*-----------------------------------------------------------------------------------------*/
/*                                          BANKET                                         */
/*-----------------------------------------------------------------------------------------*/
//admin page for bankets
function banketAdmin(){
    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    } else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }

    $video = getDataFromDb('banketvideo');

    $parser = new Parser();
    $parser->render(TM_DIR . "/views/banket/admin/banketAdmin.php", array('video' => $video[0]), true);
}

function hallAdmin(){
    $hall = getDataFromDb('bankethall');
    $hallfolio[1] = hallfolio(1);
    $hallfolio[2] = hallfolio(2);
    $hallfolio[3] = hallfolio(3);

    $parserhall = new Parser();
    $parserhall->render(TM_DIR . "/views/banket/admin/hall.php", array('hall' => $hall,'hallfolio'=>$hallfolio), true);
}
add_shortcode('hallAdmin','hallAdmin');

function hallfolio($num){
    global $wpdb;
    $folio =  $wpdb->get_results("SELECT * FROM `bankethallfolio` WHERE id_hall=".$num, ARRAY_A);
    $parserfolio = new Parser();
    return $parserfolio ->render(TM_DIR . "/views/banket/admin/hall-folio.php", array('folio' => $folio), false);
}

function programAdmin(){
    $program = getDataFromDb('banketprogram');

    $parserprogram = new Parser();
    $parserprogram->render(TM_DIR . "/views/banket/admin/program.php", array('program' => $program), true);
}
add_shortcode('programAdmin','programAdmin');

add_action('wp_ajax_banketSave', 'banketSave');
add_action('wp_ajax_nopriv_banketSave', 'banketSave');
add_action('wp_ajax_banketFolioSave', 'banketFolioSave');
add_action('wp_ajax_nopriv_banketFolioSave', 'banketFolioSave');

function banketSave(){
    global $wpdb;

    if(isset($_POST['video'])){
        $wpdb->update('banketvideo',array('video' => $_POST['video']),array('id'=>1));
    }

    if(isset($_POST['hallTitle'])){
        $wpdb->update('bankethall',array('title' => $_POST['hallTitle']),array('id'=>$_POST['hallId']));
    }

    if(isset($_POST['hallDescription'])){
        $wpdb->update('bankethall',array('description' => $_POST['hallDescription']),array('id'=>$_POST['hallId']));
    }

    if(isset($_POST['hallPeople'])){
        $wpdb->update('bankethall',array('people' => $_POST['hallPeople']),array('id'=>$_POST['hallId']));
    }

    if(isset($_POST['programTitle'])){
        $wpdb->update('banketprogram',array('title' => $_POST['programTitle']),array('id'=>$_POST['programId']));
    }

    if(isset($_POST['programDescription'])){
        $wpdb->update('banketprogram',array('description' => $_POST['programDescription']),array('id'=>$_POST['programId']));
    }
}

function banketFolioSave(){
    global $wpdb;

    if(isset($_POST['delId'])){
        $wpdb->delete('bankethallfolio',array('id'=>$_POST['delId']));
    }

    if(isset($_POST['imgId'])){
        if($_POST['imgId']=='new'){
            $wpdb->insert('bankethallfolio',array('img' => $_POST['imgUrl'],'id_hall'=>$_POST['hallId']));
        }else{
            $wpdb->update('bankethallfolio',array('img' => $_POST['imgUrl']),array('id_hall'=>$_POST['hallId'],'id'=>$_POST['imgId']));
        }
    }

}

function banketIndex(){
    global $wpdb;

    $video = getDataFromDb('banketvideo');
    $hallsDB =  $wpdb->get_results("SELECT * FROM `bankethall`", ARRAY_A);
    $programsDB =  $wpdb->get_results("SELECT * FROM `banketprogram`", ARRAY_A);
   // prn($video);
    $folio = [];
    foreach($hallsDB as $item){
        $folio[$item['id']] = $wpdb->get_results("SELECT * FROM `bankethallfolio` WHERE id_hall=".$item['id'], ARRAY_A);
    }

    $hallsPR = new Parser();
    $halls = $hallsPR ->render(TM_DIR . "/views/banket/hall.php", array('hall' => $hallsDB,'folio' => $folio), false);
    $programPR = new Parser();
    $programs = $programPR ->render(TM_DIR . "/views/banket/program.php", array('program' => $programsDB), false);

    $parser = new Parser();
    $parser->render(TM_DIR . "/views/banket/banket.php", array('video'=>$video[0],'halls' => $halls,'programs' => $programs), true);
}
add_shortcode('banketIndex','banketIndex');
/*-----------------------------------------------------------------------------------------*/
/*                                      END BANKET                                         */
/*-----------------------------------------------------------------------------------------*/


//админка страницы входа
function mainpage()
{
    global $wpdb;

    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    } else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }

    // получаем данные о всех баннерах
    $slide = getDataFromDb("mainpageslides");
    $topbanner = getDataFromDb("topbanner");
    $botbanner = getDataFromDb("botbanner");
    $leftbanner = getDataFromDb("leftbanner");
    $rightbanner = getDataFromDb("rightbanner");
    $bigbanner = getDataFromDb("bigbanner");

    //формируем блоки с заполненными данными
    //слайды
    $slides = "";
    foreach ($slide as $item) {

        $slides .= ' <div class="col-lg-12 slide" data-num="' . $item['id'] . '">
                            <p>
                                <input type="text" placeholder="Ссылка на событие" name="slide-link" class="slide-link" value="' . $item['link'] . '">
                            </p>

                            <p>
                                <button class="btn btn-info media-upload">Выбрать изображение</button>
                                <img src="' . $item['img'] . '" alt="" class="media">
                                <input type="hidden" class="media-img" name="slide-img" value="' . $item['img'] . '">
                            </p>
                            <p>
                                <button class="btn btn-success save-slide">Сохранить слайд</button>
                                <button class="btn btn-warning add-slide">Добавить слайд</button>';

        if ($item['id'] != 1) {
            $slides .= '  <button class="btn btn-danger del-slide" data-num="' . $item['id'] . '">Удалить слайд</button> ';
        }
        $slides .= '   </p>
                        </div>';
    }
    //верхний баннер
    $topbanners = '<div class="col-lg-12 top-banner">
                            <p>
                                <input type="text" placeholder="Ссылка на событие" name="top-banner-link" value="' . $topbanner[0]['link'] . '">
                            </p>

                            <p>
                                <button class="btn btn-info media-upload">Выбрать изображение</button>
                                <img src="' . $topbanner[0]['img'] . '" alt="" class="media">
                                <input type="hidden" name="top-banner-img" class="media-img" value="' . $topbanner[0]['img'] . '">
                            </p>

                            <p>
                                <button class="btn btn-success save-top-banner">Сохранить</button>
                            </p>
                        </div>';
    //нижний баннер
    $botbanners = '<div class="col-lg-12 bot-banner">
                            <p>
                                <input type="text" placeholder="Ссылка на событие" name="bot-banner-link" value="' . $botbanner[0]['link'] . '">
                            </p>

                            <p>
                                <button class="btn btn-info media-upload">Выбрать изображение</button>
                                <img src="' . $botbanner[0]['img'] . '" alt="" class="media">
                                <input type="hidden" name="bot-banner-img" class="media-img" value="' . $botbanner[0]['img'] . '">
                            </p>

                            <p>
                                <button class="btn btn-success save-bot-banner">Сохранить</button>
                            </p>
                        </div>';
    //левый баннер
    $leftbanners = '<div class="col-lg-12 left-banner">
                            <p>
                                <input type="text" placeholder="Ссылка на событие" name="left-banner-link" value="' . $leftbanner[0]['link'] . '">
                            </p>

                            <p>
                                <button class="btn btn-info media-upload">Выбрать изображение</button>
                                <img src="' . $leftbanner[0]['img'] . '" alt="" class="media">
                                <input type="hidden" name="left-banner-img" class="media-img" value="' . $leftbanner[0]['img'] . '">
                            </p>

                            <p>
                                <button class="btn btn-success save-left-banner">Сохранить</button>
                            </p>
                        </div>';
    //правый баннер
    $rightbanners = '<div class="col-lg-12 right-banner">
                            <p>
                                <input type="text" placeholder="Ссылка на событие" name="right-banner-link" value="' . $rightbanner[0]['link'] . '">
                            </p>

                            <p>
                                <button class="btn btn-info media-upload">Выбрать изображение</button>
                                <img src="' . $rightbanner[0]['img'] . '" alt="" class="media">
                                <input type="hidden" name="right-banner-img" class="media-img" value="' . $rightbanner[0]['img'] . '">
                            </p>

                            <p>
                                <button class="btn btn-success save-right-banner">Сохранить</button>
                            </p>
                        </div>';
    //Баннер
    $bigbanners = '<div class="col-lg-12 big-banner">
                            <p>
                                <input type="text" placeholder="Ссылка на событие" name="big-banner-link" value="' . $bigbanner[0]['link'] . '">
                            </p>

                            <p>
                                <button class="btn btn-info media-upload">Выбрать изображение</button>
                                <img src="' . $bigbanner[0]['img'] . '" alt="" class="media">
                                <input type="hidden" name="big-banner-img" class="media-img" value="' . $bigbanner[0]['img'] . '">
                            </p>

                            <p>
                                <button class="btn btn-success save-big-banner">Сохранить</button>
                            </p>
                        </div>';

    $parser = new Parser();
    $parser->parse(TM_DIR . "/views/mainpage.php", array('template_url' => get_template_directory_uri(),
        'slides' => $slides,
        'top' => $topbanners,
        'bot' => $botbanners,
        'left' => $leftbanners,
        'right' => $rightbanners,
        'big' => $bigbanners,
    ), true);
}

//админка наших партнеров
function partners()
{

    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    } else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }

    $partners = getDataFromDb('partners');

    $html = "";
    foreach ($partners as $item) {

        $html .= '<li class="list-group-item" data-num="' . $item['id'] . '">
                <div class="row">
                    <div class="col-lg-5">
                        <img src="' . $item['img'] . '" alt="" class="partner-img media">
                        <button class="btn btn-info media-upload"><span class="glyphicon glyphicon-picture"> Выбрать изображение</span></button>
                        <input type="hidden" class="media-img" name="partner-img" value="' . $item['img'] . '">
                    </div>
                    <div class="col-lg-5">
                        <input type="text" placeholder="Ссылка на партнера" name="partner-link" value="' . $item['link'] . '">
                    </div>
                    <div class="col-lg-1">
                        <button class="btn btn-success save-partner"><span class="glyphicon glyphicon-floppy-disk"></span></button>
                    </div>
                    <div class="col-lg-1">';
        if ($item['id'] != 1) {
            $html .= '<button class="btn btn-danger del-partner" data-num="' . $item['id'] . '"><span class="glyphicon glyphicon-trash"></span></button>';
        }

        $html .= ' </div>
                </div>
            </li>';
    }

    $parser = new Parser();
    $parser->parse(TM_DIR . "/views/partners.php", array('template_url' => get_template_directory_uri(),
        'partners' => $html,
    ), true);
}


add_filter('excerpt_more', 'excerpt_readmore');
if (function_exists('add_theme_support'))
    add_theme_support('post-thumbnails');

//nav menus wordpress
register_nav_menus(array(
    'header_menu' => 'Меню в шапке',
));

/**
 * Добавляет секции, параметры и элементы управления (контролы) на страницу настройки темы
 */
add_action('customize_register', function ($customizer) {
    /*Меню настройки контактов*/
    $customizer->add_section(
        'logo_section',
        array(
            'title' => 'Логотип',
            'description' => 'Логотип',
            'priority' => 35,
        )
    );
    $customizer->add_setting(
        'logo_textbox'
    );
    $customizer->add_control(
        new WP_Customize_Image_Control(
            $customizer,
            'logo',
            array(
                'label'      => __( 'Upload a logo', 'theme_name' ),
                'section'    => 'logo_section',
                'settings'   => 'logo_textbox'
            )
        )
    );
    /*Меню настройки контактов*/
    $customizer->add_section(
        'contacts_section',
        array(
            'title' => 'Настройки контактов',
            'description' => 'Контакты',
            'priority' => 35,
        )
    );
    $customizer->add_setting(
        'phone_textbox',
        array('default' => '+7 (3532) 24-20-20, 24-55-44')
    );
    $customizer->add_setting(
        'mail_textbox',
        array('default' => 'Shuttleclub@yandex.ru')
    );
    $customizer->add_control(
        'phone_textbox',
        array(
            'label' => 'Телефон',
            'section' => 'contacts_section',
            'type' => 'text',
        )
    );
    $customizer->add_control(
        'mail_textbox',
        array(
            'label' => 'Email',
            'section' => 'contacts_section',
            'type' => 'text',
        )
    );
    /*меню настройки соц сетей*/
    $customizer->add_section(
        'social_section',
        array(
            'title' => 'Соц. сети',
            'description' => 'Ссылки на соц. сети',
            'priority' => 35,
        )
    );
    $customizer->add_setting(
        'vk_textbox',
        array('default' => 'http://vk.com/')
    );
    $customizer->add_setting(
        'fb_textbox',
        array('default' => 'http://facebook.com/')
    );
    $customizer->add_setting(
        'insta_textbox',
        array('default' => 'http://instagram.com/')
    );
    $customizer->add_control(
        'vk_textbox',
        array(
            'label' => 'VKontakte',
            'section' => 'social_section',
            'type' => 'text',
        )
    );
    $customizer->add_control(
        'fb_textbox',
        array(
            'label' => 'Facebook',
            'section' => 'social_section',
            'type' => 'text',
        )
    );
    $customizer->add_control(
        'insta_textbox',
        array(
            'label' => 'Instagram',
            'section' => 'social_section',
            'type' => 'text',
        )
    );
});


add_action('wp_ajax_choose_main', 'choose_main');
add_action('wp_ajax_load_main', 'load_main');
add_action('wp_ajax_save_slide', 'save_slide');
add_action('wp_ajax_update_slide', 'update_slide');
add_action('wp_ajax_delete_slide', 'delete_slide');
add_action('wp_ajax_save_top_banner', 'save_top_banner');
add_action('wp_ajax_save_bot_banner', 'save_bot_banner');
add_action('wp_ajax_save_left_banner', 'save_left_banner');
add_action('wp_ajax_save_right_banner', 'save_right_banner');
add_action('wp_ajax_save_big_banner', 'save_big_banner');
add_action('wp_ajax_save_partner', 'save_partner');
add_action('wp_ajax_update_partner', 'update_partner');
add_action('wp_ajax_delete_partner', 'delete_partner');
add_action('wp_ajax_order', 'set_order');
add_action('wp_ajax_feedback', 'send_feedback');
add_action('wp_ajax_showevents', 'show_events');
add_action('wp_ajax_show_report', 'show_report');
add_action('wp_ajax_video', 'show_video');
add_action('wp_ajax_nopriv_video', 'show_video');

function show_video(){
    global $wpdb;
    $result = $wpdb->get_results("SELECT video FROM video_report WHERE id=".$_POST['id']);
    echo "<video width='720' height='420' src='".$result[0]->video."' controls></video>";
    die();
}

function set_order()
{
    $nameproduct = $_POST['nameproduct'];
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    mail(get_theme_mod('mail_textbox'), "Заказ товара с вашего сайта", "С вашего сайта заказали товар:<br>Название: $nameproduct <br> Имя заказчика: $name<br> Телефон для связи: $tel Email для связи: $email", "Content-type: text/html; charset=UTF-8\r\n");
    die();
}

// обратная связь
function send_feedback()
{
    //prn($_POST);
    $name = $_POST['name'];
    $tel = $_POST['phone'];
    $email = $_POST['email'];
    mail(get_theme_mod('mail_textbox'), "Заявка с вашего сайта", "С вашего сайта заказали обратную связь:<br> Имя : $name<br> Телефон для связи: $tel Email для связи: $email", "Content-type: text/html; charset=UTF-8\r\n");
    die();
}

//выбор главного блока
function choose_main()
{
    global $wpdb;

    if (isset($_POST['num']) && !empty($_POST['num'])) {
        $num = $_POST['num'];
        $wpdb->update('loginpage', array('num' => $num), array('id' => 1));
    }

    return load_main();
    die();
}

//сохранение нового слайде
function save_slide()
{
    global $wpdb;

    if (!empty($_POST['link']) && !empty($_POST['img'])) {
        $wpdb->insert('mainpageslides', array('link' => $_POST['link'], 'img' => $_POST['img']));
    }
    die();
}

//обновление слайда
function update_slide()
{
    global $wpdb;
    //prn($_POST);
    if (!empty($_POST['link']) && !empty($_POST['img'])) {
        $wpdb->update('mainpageslides', array('link' => $_POST['link'], 'img' => $_POST['img']), array('id' => $_POST['num']));
    }
    die();
}

//Удаление слайда
function delete_slide()
{
    global $wpdb;
    //prn($_POST);
    $wpdb->delete('mainpageslides', array('id' => $_POST['num']));
    die();
}

//Текущий блок на странице входа
function load_main()
{
    global $wpdb;
    $current_num = $wpdb->get_results("SELECT * FROM `loginpage` WHERE id = 1");
    // prn( $current_num[0]->num);
    echo $current_num[0]->num;
    die();
}

//сохранение верхнего баннера
function save_top_banner()
{
    global $wpdb;

    if (!empty($_POST['link']) && !empty($_POST['img'])) {
        $wpdb->update('topbanner', array('link' => $_POST['link'], 'img' => $_POST['img']), array('id' => 1));
    }
    die();
}

//сохранение нижнего баннера
function save_bot_banner()
{
    global $wpdb;

    if (!empty($_POST['link']) && !empty($_POST['img'])) {
        $wpdb->update('botbanner', array('link' => $_POST['link'], 'img' => $_POST['img']), array('id' => 1));
    }
    die();
}

//сохранение левого баннера
function save_left_banner()
{
    global $wpdb;

    if (!empty($_POST['link']) && !empty($_POST['img'])) {
        $wpdb->update('leftbanner', array('link' => $_POST['link'], 'img' => $_POST['img']), array('id' => 1));
    }
    die();
}

//сохранение правого баннера
function save_right_banner()
{
    global $wpdb;

    if (!empty($_POST['link']) && !empty($_POST['img'])) {
        $wpdb->update('rightbanner', array('link' => $_POST['link'], 'img' => $_POST['img']), array('id' => 1));
    }
    die();
}

//сохранение баннера
function save_big_banner()
{
    global $wpdb;

    if (!empty($_POST['link']) && !empty($_POST['img'])) {
        $wpdb->update('bigbanner', array('link' => $_POST['link'], 'img' => $_POST['img']), array('id' => 1));
    }
    die();
}

//получение всех изображений по названию таблицы
function getDataFromDb($tableName)
{
    global $wpdb;

    $data = $wpdb->get_results("SELECT * FROM `$tableName`", ARRAY_A);
    // prn($data);
    return $data;
}

//получаем главный блок
function getEnterBox()
{
    global $wpdb;
    $current_num = $wpdb->get_results("SELECT * FROM `loginpage` WHERE id = 1");
    // prn( $current_num[0]->num);
    $num = $current_num[0]->num;

    $html = "";
    //prn($num);
    if ($num == 1) {
        $slides = getDataFromDb('mainpageslides');
        $top = getDataFromDb('topbanner');
        $bot = getDataFromDb('botbanner');

        $html .= '<div class="enter__box--threeSlide">
            <div class="fotorama" data-height="360" data-width="510" data-nav="dots" data-fit="cover" data-autoplay="5000">';

        foreach ($slides as $slide) {
            $html .= '<div><a href="' . $slide['link'] . '"><img src="' . $slide['img'] . '" alt=""></a></div>';
        }

        $html .= '</div>
        <div class="enter__box--threeSlide-banners">
            <a href="' . $top[0]['link'] . '">
                <img src="' . $top[0]['img'] . '" alt="">
            </a>
            <a href="' . $bot[0]['link'] . '">
                <img src="' . $bot[0]['img'] . '" alt="">
            </a>
        </div>
        </div>';

    } else if ($num == 2) {
        $left = getDataFromDb('leftbanner');
        $right = getDataFromDb('rightbanner');

        $html .= '<div class="enter__box--twoSlide">
        <a href="' . $left[0]['link'] . '">
            <img src="' . $left[0]['img'] . '" alt="">
        </a>
        <a href="' . $right[0]['link'] . '">
            <img src="' . $right[0]['img'] . '" alt="">
        </a>
    </div>';
    } else if ($num == 3) {
        $big = getDataFromDb('bigbanner');
        $html .= '   <div class="enter__box--oneSlide" >
        <a href="' . $big[0]['link'] . '">
            <img src="' . $big[0]['img'] . '" alt="">
        </a>
    </div>';
    }

    echo $html;
}

//сохранение нового партнера
function save_partner()
{
    global $wpdb;

    if (!empty($_POST['link']) && !empty($_POST['img'])) {
        $wpdb->insert('partners', array('link' => $_POST['link'], 'img' => $_POST['img']));
    }
    die();
}

//обновление партнера
function update_partner()
{
    global $wpdb;
    //prn($_POST);
    if (!empty($_POST['link']) && !empty($_POST['img'])) {
        $wpdb->update('partners', array('link' => $_POST['link'], 'img' => $_POST['img']), array('id' => $_POST['num']));
    }
    die();
}

//Удаление партнера
function delete_partner()
{
    global $wpdb;
    //prn($_POST);
    $wpdb->delete('partners', array('id' => $_POST['num']));
    die();
}

function partners_sc()
{
    $partners = getDataFromDb('partners');

    $html = "";

    foreach ($partners as $partner) {
        $html .= '<div><a href="' . $partner['link'] . '"><img src="' . $partner['img'] . '" alt="" ></a></div>';
    }

    return $html;
}

add_shortcode('partners', 'partners_sc');

function get_event_calendar()
{
    $parser = new Parser();

    if (isset($_GET['mon'])) {
        $mon = $_GET['mon'];
        if ($_GET['mon'] == 13) {
            $mon = 1;
        }
        if ($_GET['mon'] == 0) {
            $mon = 12;
        }
        $calendar = all_calendar($mon);
    } else {
        $calendar = all_calendar();
        $a = getdate();
        $mon = $a['mon'];
    }
    $nameMon = name_mon($mon);
    $event = get_event($mon);
    $parser->parse(TM_DIR . '/views/events/all_events.php', ['calendar' => $calendar, 'event' => $event, 'namemon' => $nameMon], TRUE);
}

add_shortcode('calendar', 'get_event_calendar');


function get_event_calendar_main()
{
    $parser = new Parser();
    if (isset($_GET['mon'])) {
        $mon = $_GET['mon'];
        if ($_GET['mon'] == 13) {
            $mon = 1;
        }
        if ($_GET['mon'] == 0) {
            $mon = 12;
        }
        $calendar = all_calendar($mon);
    } else {
        $calendar = all_calendar();
        $a = getdate();
        $mon = $a['mon'];
    }
    /*$nameMon = name_mon($mon);
    $event = get_event($mon);*/
    $parser->parse(TM_DIR . '/views/events/calendar_main.php', ['calendar' => $calendar], TRUE);
}

add_shortcode('calendar_main', 'get_event_calendar_main');


function all_calendar($mon = 0)
{

    $parser = new Parser();
    if (($mon == 0)) {
        $a = getdate();
        $currentYear = $a['year'];
        $currentMon = $a['mon'];
        $dayMon = cal_days_in_month(CAL_GREGORIAN, $currentMon, $currentYear);
        $allMon = [1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'];
        $mon = '';
        for ($i = 1; $i <= 12; $i++) {
            if ($i == $currentMon) {
                $mon .= "<span class='currentMon'> <a href='?mon=$i'>$allMon[$i]</a> </span>";
            } else {
                $mon .= "<span class='mon'> <a data-id='$i' id='linkMon' href='?mon=$i'>$allMon[$i]</a> </span>";
            }

        }
        $eventDay = get_event_day($currentMon);
        $trans = array_flip ($eventDay);
        $days = '';
        for ($i = 1; $i <= $dayMon; $i++) {
            if (in_array($i, $eventDay)) {
                $infoEvents = get_name_events($trans[$i]);

                $days .= "<span class='selectDay'> $i <div class='popup_block'>".$infoEvents['title']."<br /><a href='".$infoEvents['link']."'>Перейти</a></div></span>";
            } else {
                $days .= "<span class='day'> $i </span>";
            }
        }
        $calendar = $parser->parse(TM_DIR . '/views/calendar/calendar.php', ['days' => $days, 'mon' => $mon, 'currentmonleft' => $currentMon - 1, 'currentmonright' => $currentMon + 1], FALSE);
    } else {
        $a = getdate();
        $currentYear = $a['year'];
        $currentMon = $mon;
        $dayMon = cal_days_in_month(CAL_GREGORIAN, $currentMon, $currentYear);
        $allMon = [1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'];
        $mon = '';
        for ($i = 1; $i <= 12; $i++) {
            if ($i == $currentMon) {
                $mon .= "<span class='currentMon'> <a href='?mon=$i'>$allMon[$i]</a> </span>";
            } else {
                $mon .= "<span class='mon'> <a data-id='$i' id='linkMon' href='?mon=$i'>$allMon[$i]</a> </span>";
            }

        }
        $eventDay = get_event_day($currentMon);
        $trans = array_flip ($eventDay);
        $days = '';
        if (!isset($eventDay)) {
            for ($i = 1; $i <= $dayMon; $i++) {
                $days .= "<span class='day'> $i </span>";
            }
        } else {
            for ($i = 1; $i <= $dayMon; $i++) {
                if (in_array($i, $eventDay)) {
                    $infoEvents = get_name_events($trans[$i]);

                    $days .= "<span class='selectDay'> $i <div class='popup_block'>".$infoEvents['title']."<br /><a href='".$infoEvents['link']."'>Перейти</a></div></span>";
                } else {
                    $days .= "<span class='day'> $i </span>";
                }
            }
        }
        $calendar = $parser->parse(TM_DIR . '/views/calendar/calendar.php', ['days' => $days, 'mon' => $mon, 'currentmonleft' => $currentMon - 1, 'currentmonright' => $currentMon + 1], FALSE);
    }
    return $calendar;
}

function get_name_events($id){
    $mypost = get_post($id);

    $res['title'] = $mypost->post_title;
    $res['link'] = $mypost->guid;
    return $res;
}


function get_event_day($mon)
{
    $mypost = array('post_type' => 'event',);
    $loop = new WP_Query($mypost);
    $arr_date = [];
    foreach ($loop->posts as $sob) {
        $date = get_post_meta($sob->ID, 'date', TRUE);
        $date = explode('-', $date);
        if ($date[1][0] == 0) {
            if ($date[1][0] == $mon) {
                $arr_date[$sob->ID] = $date[2];
            }
        } else {
            if ($date[1] == $mon) {
                $arr_date[$sob->ID] = $date[2];
            }
        }
    }
    $arr_end_date = [];
    foreach ($arr_date as $d=>$v) {
        //prn($v);
        //prn($arr_date);
        if ($v[0] == 0) {
            $arr_end_date[$d] = $v[1];
        } else {
            $arr_end_date[$d] = $v;
        }
    }
    return $arr_end_date;
}

function get_event($mon)
{
    $parser = new Parser();
    $mypost = array('post_type' => 'event', 'orderby' => 'meta_value', 'meta_key' => 'date', 'order' => 'ASC');
    $loop = new WP_Query($mypost);
    $event = '';
    $nameMon = name_mon($mon);

    foreach ($loop->posts as $sob) {
        $img = get_the_post_thumbnail($sob->ID);
        $date = get_post_meta($sob->ID, 'date', TRUE);
        $date = explode('-', $date);
        if ($date[2][0] == 0) {
            $dateEvent = $date[2][1];
        } else {
            $dateEvent = $date[2];
        }
        if ($date[1][0] == 0) {
            if ($date[1][1] == $mon) {
                $event .= $parser->parse(TM_DIR . '/views/events/event.php', ['name' => $sob->post_title, 'img' => $img, 'number' => $dateEvent, 'link' => $sob->guid, 'namemon' => $nameMon], FALSE);
            }
        } else {
            if ($date[1] == $mon) {
                $event .= $parser->parse(TM_DIR . '/views/events/event.php', ['name' => $sob->post_title, 'img' => $img, 'number' => $dateEvent, 'link' => $sob->guid, 'namemon' => $nameMon], FALSE);
            }
        }
    }
    return $event;
}

function name_mon($mon)
{
    $months = Array(
        '1' => 'января',
        '2' => 'февраля',
        '3' => 'марта',
        '4' => 'апреля',
        '5' => 'мая',
        '6' => 'июня',
        '7' => 'июля',
        '8' => 'августа',
        '9' => 'сентября',
        '10' => 'октября',
        '11' => 'ноября',
        '12' => 'декабря'
    );
    return $months[$mon];
}

/*------День недели по дате-----*/
function get_day_week($date){
    $date=explode("-", $date);
    $day = date("w", mktime(0, 0, 0, $date[1], $date[2], $date[0]));
    $week=array(
        1=> "Понедельник",
        2=>"Вторник",
        3=>"Срееда",
        4=>"Четверг",
        5=>"Пятница",
        6=>"Суббота",
        7=>"Воскресенье"
    );
    return $week[$day];
}

function upcoming_events($mon,$id){
    $parser = new Parser();
    $event = get_upcoming_event($mon,$id);
    $parser->parse(TM_DIR . '/views/events/upcoming_events.php', ['event' => $event],true);

}

function get_upcoming_event($mon,$id)
{
    $parser = new Parser();
    $mypost = array('post_type' => 'event', 'orderby' => 'meta_value', 'meta_key' => 'date', 'order' => 'ASC', 'LIMIT'=>4);
    $loop = new WP_Query($mypost);
    $event = '';
    $nameMon = name_mon($mon);
    $i = 0;
    foreach ($loop->posts as $sob) {
        if($i == 4){break;}
        if($sob->ID != $id){
            $img = get_the_post_thumbnail($sob->ID);
            $date = get_post_meta($sob->ID, 'date', TRUE);
            $date = explode('-', $date);
            if ($date[2][0] == 0) {
                $dateEvent = $date[2][1];
            } else {
                $dateEvent = $date[2];
            }
            if ($date[1][0] == 0) {
                if ($date[1][1] == $mon) {
                    $event .= $parser->parse(TM_DIR . '/views/events/event.php', ['name' => $sob->post_title, 'img' => $img, 'number' => $dateEvent, 'link' => $sob->guid, 'namemon' => $nameMon], FALSE);
                    $i++;
                }
            } else {
                if ($date[1] == $mon) {
                    $event .= $parser->parse(TM_DIR . '/views/events/event.php', ['name' => $sob->post_title, 'img' => $img, 'number' => $dateEvent, 'link' => $sob->guid, 'namemon' => $nameMon], FALSE);
                    $i++;
                }
            }
        }

    }
    return $event;
}

function photo_report_menu_page(){
    add_menu_page( 'Фоторепортаж', 'Фоторепортаж', 'administrator', 'photo_report', 'photo_report_admin_page' );
}

add_action('admin_menu', 'photo_report_menu_page');

function photo_report_admin_page(){
    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    } else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }
    $parser = new Parser();
    if(isset($_GET['action'])) {
        if ($_GET['action'] == 'add_photo_report') {
            if(isset($_POST['photo_report_save'])){
                $photo = new Photo_report();
               /* if(isset($_POST['kv_multiple_attachments_img'])) {
                    $photo->upload_img($_POST['id_event'], $_POST['kv_multiple_attachments_img']);
                }*/
                if(isset($_POST['kv_multiple_attachments_vid'])){
                    $photo->upload_vid($_POST['id_event'], $_POST['kv_multiple_attachments_vid']);
                }
                /*if(isset($_POST['cover_img'])){
                    $photo->upload_cover($_POST['id_event'],$_POST['cover_img']);
                }*/
                print_photo_report();
            }else{
                $parser->parse(TM_DIR . '/views/photo_report/photo_report_add.php', array(), TRUE);
            }

        }
        if($_GET['action'] == 'delit'){
            $photo = new Photo_report();
            $photo->delite_img($_GET['id']);
            print_photo_report();
        }
        if($_GET['action'] == 'edit_photo_report'){
            $photo = new Photo_report();
            $img = $photo->get_img_report($_GET['id']);
            $date = $photo->get_date_post($_GET['id']);
            $link = get_template_directory_uri();
            $images = '';
            foreach($img as $i){
                $images .= $parser->parse(TM_DIR . '/views/photo_report/list_img_photo_report.php', array('img'=>$i->images,'link'=>$link,'id_images'=>$i->id), FALSE);
            }
            $parser->parse(TM_DIR . '/views/photo_report/edit_photo_report.php', array('date'=>$date,'images'=>$images), TRUE);
        }
    }
    else{
        print_photo_report();
    }
}

function print_photo_report(){
    $parser = new Parser();
    $photo = new Photo_report();
    $id = $photo->get_img_event();

    $event = '';
    foreach($id as $p){
        $k = get_post($p);
        $videos = $photo->get_video_report($p);
       // prn($videos);
        if(!empty($videos)){
            $event .= $parser->render(TM_DIR . '/views/photo_report/list_photo_report.php', ['name'=>$k->post_title,'ID'=>$k->ID,'video' => $videos], false);
        }
    }
    $parser->parse(TM_DIR . '/views/photo_report/photo_report.php', ['events'=>$event], TRUE);
}

add_action('wp_ajax_get_event_admin', 'get_event_admin');

function get_event_admin(){
    $mypost = array('post_type' => 'event', 'orderby' => 'meta_value', 'meta_key' => 'date', 'order' => 'ASC');
    $loop = new WP_Query($mypost);
    foreach($loop->posts as $v ){
        $date = get_post_meta($v->ID, 'date', TRUE);
        if($date == $_POST['date']){
            $events = $v;
        }
    }

        $events = json_encode($events);
        echo  $events;
die();
}

function show_report($id){
    $parser = new Parser();
    $photo = new Photo_report();
    $img = $photo->get_img_report($id);
    $video = $photo->get_video_report($id);
    $idGal = get_post_meta($id, 'gallery', 1);

    $video_arr = '';
    foreach ($video as $v) {
        $video_arr .=  $parser->parse(TM_DIR . '/views/photo_report/site/video_report.php', array('video' => stripslashes($v->video),'id'=>$v->id), FALSE);
    }

    $link = get_template_directory_uri();
    $images = '';
    $count = 0;
    foreach($img as $i){
        $images .= $parser->parse(TM_DIR . '/views/photo_report/site/show_img.php', array('img'=>$i->images,'link'=>$link,'id'=>$i->id,'count'=>$count), FALSE);
        $count++;
    }
    $parser->render(TM_DIR . '/views/photo_report/site/show_photo_report.php', array('video'=>$video_arr,'id'=>$idGal), true);

}

add_action('wp_ajax_slider_events', 'get_slider_events');
add_action('wp_ajax_nopriv_slider_events', 'get_slider_events');
function get_slider_events(){
    $parser = new Parser();
    $photo = new Photo_report();
    $img = $photo->get_img_report($_POST['id']);
    $result['img'] = $img;
    $result['link']= get_template_directory_uri();
    $slider = $parser->render(TM_DIR . '/views/slider_img_events.php', array('result'=>$result), false);
    echo $slider;
    die();
}

function other_events($mon,$id){
    $parser = new Parser();
    $event = get_upcoming_event($mon,$id);
    $parser->parse(TM_DIR . '/views/events/other_events/other_events.php', ['event' => $event],true);
}

function get_upcoming_other_event($mon,$id,$count=0)
{
   // prn($count);
    global $wpdb;
    $parser = new Parser();
    $mypost = array('post_type' => 'event', 'orderby' => 'meta_value', 'meta_key' => 'date', 'order' => 'ASC', 'nopaging' => true);
    $loop = new WP_Query($mypost);
    $event = '';
    $nameMon = name_mon($mon);

    $c = 0;

    foreach ($loop->posts as $sob) {
        if($sob->ID != $id){
            $photo = new Photo_report();
            //photos

            $imgGal = get_post_meta($sob->ID, "gallery", 1);
            $gallery = $wpdb->get_results('SELECT * FROM  `wp_ngg_pictures` WHERE  `galleryid` = '.$imgGal);
            $countGal = count($gallery);
            $coverGalId= $wpdb->get_results('SELECT * FROM  `wp_ngg_gallery` WHERE  `gid` = '.$imgGal);
            $coverGal = $wpdb->get_results('SELECT * FROM  `wp_ngg_pictures` WHERE  `pid` = '.$coverGalId[0]->previewpic);
            $coverGal = $coverGalId[0]->path."/".$coverGal[0]->filename;

           // $countImg = count($img);
            $countvideo = count($photo->get_video_report($sob->ID));
            if(!empty($imgGal)){
                if($c<$count){
                    $c++;
                }else if($count !=0 ){
                    continue;
                };
               // $photoCover = $photo->get_cover_report($sob->ID);
                $date = get_post_meta($sob->ID, 'date', TRUE);
                $date = explode('-', $date);
                if ($date[2][0] == 0) {
                    $dateEvent = $date[2][1];
                } else {
                    $dateEvent = $date[2];
                }
                if ($date[1][0] == 0) {
                    if ($date[1][1] == $mon) {
                       // $event .= $parser->parse(TM_DIR . '/views/events/other_events/other_events.php', ['name' => $sob->post_title, 'img' => $photoCover, 'number' => $dateEvent, 'link' => $sob->guid, 'namemon' => $nameMon,'linkImg'=>get_template_directory_uri(),'countPhoto'=>$countImg,'countvideo'=>$countvideo], TRUE);
                        $event .= $parser->parse(TM_DIR . '/views/events/other_events/other_events.php', ['name' => $sob->post_title, 'img' => $coverGal, 'number' => $dateEvent, 'link' => $sob->guid, 'namemon' => $nameMon,'linkImg'=>get_template_directory_uri(),'countPhoto'=>$countGal,'countvideo'=>$countvideo],true);
                       // $event .= $parser->parse(TM_DIR . '/views/events/other_events/other_events.php', ['name' => $sob->post_title, 'img' => $photoCover, 'number' => $dateEvent, 'link' => $sob->guid, 'namemon' => $nameMon,'linkImg'=>get_template_directory_uri(),'countPhoto'=>$countImg,'countvideo'=>$countvideo], TRUE);
                    }
                } else {
                    if ($date[1] == $mon) {
                     //   $event .= $parser->parse(TM_DIR . '/views/events/other_events/other_events.php', ['name' => $sob->post_title, 'img' => $photoCover, 'number' => $dateEvent, 'link' => $sob->guid, 'namemon' => $nameMon,'linkImg'=>get_template_directory_uri(),'countPhoto'=>$countImg,'countvideo'=>$countvideo], TRUE);
                        $event .= $parser->parse(TM_DIR . '/views/events/other_events/other_events.php', ['name' => $sob->post_title, 'img' => $coverGal, 'number' => $dateEvent, 'link' => $sob->guid, 'namemon' => $nameMon,'linkImg'=>get_template_directory_uri(),'countPhoto'=>$countGal,'countvideo'=>$countvideo],true);
                      //  $event .= $parser->parse(TM_DIR . '/views/events/other_events/other_events.php', ['name' => $sob->post_title, 'img' => $photoCover, 'number' => $dateEvent, 'link' => $sob->guid, 'namemon' => $nameMon,'linkImg'=>get_template_directory_uri(),'countPhoto'=>$countImg,'countvideo'=>$countvideo], TRUE);
                    }
                }
            }
        }
    }
    return $event;
}

//add_action('get_slider_events','slider_events');


function parent_menu_page(){
    add_menu_page( 'Партнеры', 'Партнеры', 'administrator', 'parent', 'parent_admin_page' );
}

add_action('admin_menu', 'parent_menu_page');

function parent_admin_page(){
    $parser = new Parser();
    if(isset($_GET['action'])) {
        if ($_GET['action'] == 'add_parent') {
            if(isset($_POST['uploadimg'])){
                $_POST['uploadimg'];
                $parent = new Parent_events();
                $parent->upload_img($_POST['id_event'],$_FILES);
                print_parent();
            }else{
                $parser->parse(TM_DIR . '/views/parent/add_parent.php', array(), TRUE);
            }
        }
        if($_GET['action'] == 'delit'){
            $parent = new Parent_events();
            $parent->delite_img($_GET['id']);
            print_parent();
        }
    }
    else{
        print_parent();
    }

}

function print_parent(){
    $parser = new Parser();
    $parent = new Parent_events();
    $id = $parent->get_img_event();
    $event = '';
    foreach($id as $p){
        $k = get_post($p);
        $event .= $parser->parse(TM_DIR . '/views/parent/list_parent.php', ['name'=>$k->post_title,'ID'=>$k->ID], false);
    }
    $parser->parse(TM_DIR . '/views/parent/parent.php', ['event'=>$event], TRUE);
}

function get_parent($id){
    $parser = new Parser();
    $parent =  new Parent_events();
    $parentImg = $parent->get_parent_img($id);
    $parentImgList = '';
    $link = get_template_directory_uri();
    if(!empty($parentImg)){
        foreach($parentImg as $pr){
            $parentImgList .= $parser->parse(TM_DIR . '/views/parent/site/parent.php',['img'=>$pr,'link'=>$link],FALSE);
        }
     return $parser->parse(TM_DIR . '/views/parent/site/show_parent.php',['parentImgList'=>$parentImgList],TRUE);
    }
}



/*-------------------Стол находок--------------------*/
add_action('init', 'lost_found');
function lost_found()
{
    $labels = array(
        'name' => 'Стол находок', // Основное название типа записи
        'singular_name' => 'Стол находок', // отдельное название записи типа Book
        'add_new' => 'Добавить находку',
        'add_new_item' => 'Добавить новыую находку',
        'edit_item' => 'Редактировать находку',
        'new_item' => 'Новая находка',
        'view_item' => 'Посмотреть находку',
        'search_items' => 'Найти находку',
        'not_found' => 'Находок не найдено',
        'not_found_in_trash' => 'В корзине находок не найдено',
        'parent_item_colon' => '',
        'menu_name' => 'Стол находок'

    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail')
    );
    register_post_type('lost_found', $args);
}

// Добавляем фильтр, который изменит сообщение при публикации при изменении типа записи Book
add_filter('post_updated_messages', 'lost_found_updated_messages');
function lost_found_updated_messages($messages)
{
    global $post, $post_ID;

    $messages['product'] = array(
        0 => '', // Не используется. Сообщения используются с индекса 1.
        1 => sprintf('Book обновлено. <a href="%s">Посмотреть запись book</a>', esc_url(get_permalink($post_ID))),
        2 => 'Произвольное поле обновлено.',
        3 => 'Произвольное поле удалено.',
        4 => 'Запись Book обновлена.',
        /* %s: дата и время ревизии */
        5 => isset($_GET['revision']) ? sprintf('Запись Book восстановлена из ревизии %s', wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6 => sprintf('Находка опубликована. <a href="%s">Перейти к находке</a>', esc_url(get_permalink($post_ID))),
        7 => 'Запись Book сохранена.',
        8 => sprintf('Находка сохранена. <a target="_blank" href="%s">Предпросмотр находки</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf('Запись Book запланирована на: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр записи book</a>',
            // Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
            date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf('Черновик записи Book обновлен. <a target="_blank" href="%s">Предпросмотр записи book</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;
}


add_action('add_meta_boxes', 'lost_found_extra_fields', 1);

function lost_found_extra_fields() {
    add_meta_box( 'lost_found_extra_fields', 'Найдено или нет?', 'extra_fields_lost_found_func', 'lost_found', 'normal', 'high'  );
}

function extra_fields_lost_found_func($post){?>
<p>Найдено или нет?: <?php $mark_v = get_post_meta($post->ID, 'lost_found', 1); ?>
<label><input type="radio" name="extra[lost_found]" value="found" <?php checked( $mark_v, '' ); ?> /> Найдено</label>
<label><input type="radio" name="extra[lost_found]" value="not_found" <?php checked( $mark_v, 'not_found' ); ?> /> Не найдено</label>

</p>
<?php
}
    /*--------------Конец стол находок--------*/

function get_name_mon($mon){
    $months = Array(
        '1' => 'январь',
        '2' => 'февраль',
        '3' => 'март',
        '4' => 'апрель',
        '5' => 'май',
        '6' => 'июнь',
        '7' => 'июль',
        '8' => 'август',
        '9' => 'сентябрь',
        '10' => 'октябрь',
        '11' => 'ноябрь',
        '12' => 'декабрь'
    );
    return $months[$mon];
}

function count_report($mon){

    $mypost = array('post_type' => 'event', 'orderby' => 'meta_value', 'meta_key' => 'date', 'order' => 'ASC');
    $loop = new WP_Query($mypost);
    $count = 0;
    foreach ($loop->posts as $sob) {
        $date = get_post_meta($sob->ID, 'date', TRUE);
        $date = explode('-', $date);

        if($date[1][0] == 0){
            $monEvent = $date[1][1];
        }
        else{
            $monEvent = $date[1];
        }

        if($monEvent == $mon) {
            global $wpdb;
            $gallery = get_post_meta($sob->ID, 'gallery', TRUE);
            //prn($gallery);
            //$cover = $wpdb->get_results("SELECT * FROM cover_report WHERE id_event=$sob->ID");
            //if (!empty($cover)) {
            if (!empty($gallery)) {
                $count++;
            }

        }
    }
    return $count;
}
/*-------------------Доска почета---------------------------------*/
add_action('init', 'hall_fame_init_event');
function hall_fame_init_event()
{
    $labels = array(
        'name' => 'Доска почета', // Основное название типа записи
        'singular_name' => 'Доска почета', // отдельное название записи типа Book
        'add_new' => 'Добавить',
        'add_new_item' => 'Добавить',
        'edit_item' => 'Редактировать',
        'new_item' => 'Новое',
        'view_item' => 'Посмотреть',
        'search_items' => 'Найти',
        'not_found' => 'Ни чего нет',
        'not_found_in_trash' => 'В корзине не найдено',
        'parent_item_colon' => '',
        'menu_name' => 'Доска почета'

    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail')
    );
    register_post_type('hall_fame', $args);
}

// Добавляем фильтр, который изменит сообщение при публикации при изменении типа записи Book
add_filter('post_updated_messages', 'hall_fame_updated_messages_event');
function hall_fame_updated_messages_event($messages)
{
    global $post, $post_ID;

    $messages['hall_fame'] = array(
        0 => '', // Не используется. Сообщения используются с индекса 1.
        1 => sprintf('Book обновлено. <a href="%s">Посмотреть запись book</a>', esc_url(get_permalink($post_ID))),
        2 => 'Произвольное поле обновлено.',
        3 => 'Произвольное поле удалено.',
        4 => 'Запись Book обновлена.',
        /* %s: дата и время ревизии */
        5 => isset($_GET['revision']) ? sprintf('Запись Book восстановлена из ревизии %s', wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6 => sprintf('Событие опубликовано. <a href="%s">Перейти к продукту</a>', esc_url(get_permalink($post_ID))),
        7 => 'Запись Book сохранена.',
        8 => sprintf('Событие сохранено. <a target="_blank" href="%s">Предпросмотр продукта</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf('Запись Book запланирована на: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр записи book</a>',
            // Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
            date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf('Черновик записи Book обновлен. <a target="_blank" href="%s">Предпросмотр записи book</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;
}


add_action('add_meta_boxes', 'hall_fame_extra_fields', 1);

function hall_fame_extra_fields() {
    add_meta_box( 'hall_fame_extra_fields', 'Выберите изображения', 'extra_fields_hall_fame', 'hall_fame', 'normal', 'high'  );
}

function extra_fields_hall_fame( $post ){
?>
    <p><b>Выберите изображение1:</b><br>
    <p><img class="custom_media_image1" src="" alt="" style="width: 80px;"></p>
    <p><button class="custom_media_upload1">Загрузить</button></p>
    <p><input id="image" class="custom_media_url1" type="text" name="extra[attachment_url][]" value=""></p>

    <p><b>Выберите изображение2:</b><br>
    <p><img class="custom_media_image2" src="" alt="" style="width: 80px;"></p>
    <p><button class="custom_media_upload2">Загрузить</button></p>
    <p><input id="image" class="custom_media_url2" type="text" name="extra[attachment_url][]" value=""></p>

    <p><b>Выберите изображение3:</b><br>
    <p><img class="custom_media_image3" src="" alt="" style="width: 80px;"></p>
    <p><button class="custom_media_upload3">Загрузить</button></p>
    <p><input id="image" class="custom_media_url3" type="text" name="extra[attachment_url][]" value=""></p>

    <p><b>Выберите изображение4:</b><br>
    <p><img class="custom_media_image4" src="" alt="" style="width: 80px;"></p>
    <p><button class="custom_media_upload4">Загрузить</button></p>
    <p><input id="image" class="custom_media_url4" type="text" name="extra[attachment_url][]" value=""></p>

    <p><b>Выберите изображение5:</b><br>
    <p><img class="custom_media_image5" src="" alt="" style="width: 80px;"></p>
    <p><button class="custom_media_upload5">Загрузить</button></p>
    <p><input id="image" class="custom_media_url5" type="text" name="extra[attachment_url][]" value=""></p>
<?php
}


add_action('add_meta_boxes', 'hall_fame_extra_fields_events', 1);

function hall_fame_extra_fields_events() {
    add_meta_box( 'hall_fame_extra_fields_events', 'Дополнительные поля', 'extra_fields_hall_fame_events', 'hall_fame', 'normal', 'high'  );
}

function extra_fields_hall_fame_events( $post ){
    ?>
    <input type="date" name="date_hall_fame" id="date_hall_fame"/>
    <input type="hidden" name="extra[id_event_hall_fame]" id="id_event_hall_fame" value=""/>
    <div class="oneEvent"></div>
<?php
}



/*--------------------Конец доски почета---------------------------------*/

function img_galeri($id){
    $parser = new Parser();
    global $wpdb;
    $result['img'] = $wpdb->get_results("SELECT * FROM wp_ngg_pictures WHERE galleryid=".$id['id']);
    $result['link'] = $wpdb->get_results(("SELECT path FROM wp_ngg_gallery WHERE gid=".$id['id']));
   $p = $parser->render(TM_DIR . '/views/galery/galery.php', array('result' =>$result), false);
   return $p;
}


add_shortcode('gal', 'img_galeri');

/*собираем почты пользователей*/
add_action('wp_ajax_doneEmail', 'doneEmail');
add_action('wp_ajax_nopriv_doneEmail', 'doneEmail');

function doneEmail(){

    $id = get_current_user_id();

    if(isset($_POST['email']) && !empty($_POST['email'])){
        wp_update_user( array( 'ID' => $id, 'user_email' => $_POST['email'] ) );
    }

    if(isset($_POST['check'])){
        $user = get_userdata($id);
        $currentEmail = $user->user_email;

        $vkMail = substr($currentEmail,-6);

        if($vkMail == 'vk.com'){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    die();
}

/*собираем почты пользователей*/
add_action('wp_ajax_deleteVideo', 'delVidFromDb');
add_action('wp_ajax_nopriv_deleteVideo', 'delVidFromDb');

function delVidFromDb(){
    global $wpdb;

    $id = $_POST['id'];

    if(isset($id)){
        $wpdb->delete('video_report',array( 'id' => $id ));
    }
    
    die();
}