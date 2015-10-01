<?php

function add_style(){
    wp_enqueue_style( 'my-bootstrap-extension', get_template_directory_uri() . '/css/bootstrap.css', array(), '1');
    wp_enqueue_style( 'my-styles', get_template_directory_uri() . '/css/style.css', array('my-bootstrap-extension'), '1');
    wp_enqueue_style( 'my-sass', get_template_directory_uri() . '/sass/style.css', array('my-bootstrap-extension'), '1');
    wp_enqueue_style( 'fotorama', get_template_directory_uri() . '/css/fotorama.css', array('my-bootstrap-extension'), '1');
}

function add_script(){
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-2.1.3.min.js', array(), '1');
    wp_enqueue_script( 'jq', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), '1');
    wp_enqueue_script( 'my-bootstrap-extension', get_template_directory_uri() . '/js/bootstrap.js', array(), '1');
    wp_enqueue_script( 'my-script', get_template_directory_uri() . '/js/script.js', array(), '1');
    wp_enqueue_script( 'fotorama-js', get_template_directory_uri() . '/js/fotorama.js', array(), '1');

    
}

add_action( 'wp_enqueue_scripts', 'add_style' );
add_action( 'wp_enqueue_scripts', 'add_script' );

function prn($content) {
    echo '<pre style="background: lightgray; border: 1px solid black; padding: 2px">';
    print_r ( $content );
    echo '</pre>';
}

function my_pagenavi() {
    global $wp_query;

    $big = 999999999; // уникальное число для замены

    $args = array(
        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) )
    ,'format' => ''
    ,'current' => max( 1, get_query_var('paged') )
    ,'total' => $wp_query->max_num_pages
    );

    $result = paginate_links( $args );

    // удаляем добавку к пагинации для первой страницы
    $result = str_replace( '/page/1/', '', $result );

    echo $result;
}

function excerpt_readmore($more) {
    return '... <br><a href="'. get_permalink($post->ID) . '" class="readmore">' . 'Читать далее' . '</a>';
}
add_filter('excerpt_more', 'excerpt_readmore');


if ( function_exists( 'add_theme_support' ) )
    add_theme_support( 'post-thumbnails' );

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
        'not_found' =>  'Товаров не найдено',
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
        'supports' => array('title','editor','thumbnail')
    );
    register_post_type('product',$args);
}

// Добавляем фильтр, который изменит сообщение при публикации при изменении типа записи Book
add_filter('post_updated_messages', 'product_updated_messages');
function product_updated_messages( $messages ) {
    global $post, $post_ID;

    $messages['product'] = array(
        0 => '', // Не используется. Сообщения используются с индекса 1.
        1 => sprintf( 'Book обновлено. <a href="%s">Посмотреть запись book</a>', esc_url( get_permalink($post_ID) ) ),
        2 => 'Произвольное поле обновлено.',
        3 => 'Произвольное поле удалено.',
        4 => 'Запись Book обновлена.',
        /* %s: дата и время ревизии */
        5 => isset($_GET['revision']) ? sprintf( 'Запись Book восстановлена из ревизии %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( 'Товар опубликован. <a href="%s">Перейти к продукту</a>', esc_url( get_permalink($post_ID) ) ),
        7 => 'Запись Book сохранена.',
        8 => sprintf( 'Продукт сохранен. <a target="_blank" href="%s">Предпросмотр продукта</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( 'Запись Book запланирована на: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр записи book</a>',
            // Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( 'Черновик записи Book обновлен. <a target="_blank" href="%s">Предпросмотр записи book</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}


function my_extra_fields() {
    add_meta_box( 'extra_fields', 'Цена', 'extra_fields_box_func', 'product', 'normal', 'high'  );
    add_meta_box( 'extra_fields', 'Дата', 'extra_fields_sobit_func', 'sobit', 'normal', 'high'  );
}
add_action('add_meta_boxes', 'my_extra_fields', 1);



function extra_fields_box_func( $post ){
    ?>
    <p><span>Введите только цифры.</span><input type="text" pattern="\d+(\.\d{2})?" name="extra[price]" value="<?php echo get_post_meta($post->ID, 'price', 1); ?>" style="width:50%" /></p>
<?php
}


add_action('save_post', 'my_extra_fields_update', 10, 1);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update( $post_id ){
    
    if( !isset($_POST['extra']) ) return false;
    foreach( $_POST['extra'] as $key=>$value ){
        if( empty($value) ){
            delete_post_meta($post_id, $key); // удаляем поле если значение пустое
            continue;
        }

        update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
    }
    return $post_id;
}

/*-------------------------КОНЕЦ МАГАЗИНА-------------------------------*/

/*------------------------СТРАНИЦА СОБЫТИЯ------------------------------*/
add_action('init', 'my_custom_init_sobit');
function my_custom_init_sobit()
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
        'not_found' =>  'Событий не найдено',
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
        'supports' => array('title','editor','thumbnail')
    );
    register_post_type('sobit',$args);
}

// Добавляем фильтр, который изменит сообщение при публикации при изменении типа записи Book
add_filter('post_updated_messages', 'product_updated_messages_sobit');
function product_updated_messages_sobit( $messages ) {
    global $post, $post_ID;

    $messages['product'] = array(
        0 => '', // Не используется. Сообщения используются с индекса 1.
        1 => sprintf( 'Book обновлено. <a href="%s">Посмотреть запись book</a>', esc_url( get_permalink($post_ID) ) ),
        2 => 'Произвольное поле обновлено.',
        3 => 'Произвольное поле удалено.',
        4 => 'Запись Book обновлена.',
        /* %s: дата и время ревизии */
        5 => isset($_GET['revision']) ? sprintf( 'Запись Book восстановлена из ревизии %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( 'Событие опубликовано. <a href="%s">Перейти к продукту</a>', esc_url( get_permalink($post_ID) ) ),
        7 => 'Запись Book сохранена.',
        8 => sprintf( 'Событие сохранено. <a target="_blank" href="%s">Предпросмотр продукта</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( 'Запись Book запланирована на: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр записи book</a>',
            // Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( 'Черновик записи Book обновлен. <a target="_blank" href="%s">Предпросмотр записи book</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}




function extra_fields_sobit_func( $post ){
    ?>
    <!--<p><input type="text" name="extra[date]" value="<?php /*echo get_post_meta($post->ID, 'date', 1); */?>" style="width:50%" /></p>-->
    <input type="date" name="extra[date]" value="<?php echo get_post_meta($post->ID, 'date', 1); ?>" max="2200-12-31" min="2015-05-29">
<?php
}




/*-------------------- КОНЕЦ СТРАНИЦА СОБЫТИЯ---------------------------*/
