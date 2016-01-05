<?php

require( 'dz7_common_functions.php' );
require( 'dz7_1_functions.php' );

// Точка входа

// Загрузка данных из cookie
if (isset($_COOKIE['AD'])) {
    $ads = unserialize($_COOKIE['AD']);
}

$msg_ad_status = ''; // Информационная строка, которая будет выводиться перед формой, и будет уведомлять пользователя о том сохранено ли его объявление
if (isset($_POST['seller_name'])) { // Кнопка 'Отправить' нажата?
    if (AD_check_n_view_errors()) { // Проверяем заполнены ли все необходимые поля
        $AD_flag = 1; // Установка флага в значение 1: не заполнены нужные поля, пользователь должен внести все необходимые данные
    } else {
        $post = $_POST;
        $post['date_change'] = time(); // Добавление временной метки последнего внесения изменений в объявление
        $msg_ad_status = 'Объявление ' . trim(htmlspecialchars($post['title'])) . ' за ' . (int) $post['price'] . ' руб.';

        if (isset($post['AD_ID']) and $post['AD_ID'] >= 0) { // Внесение изменений в существующее объявление
            $ads[$post['AD_ID']] = $post;
            $msg_ad_status .= ' сохранено';
        } else {
            $ads[] = $post; // Добавляем новое объявление
            $msg_ad_status .= ' добавлено';
        }
        set_ads_in_cookie();
    }
}

if (isset($_GET['del_id'])) { // Удалить объявление
    $del_id = (int) $_GET['del_id'];
    if (isset($ads[$del_id])) {
        unset($ads[$del_id]);
        set_ads_in_cookie();
        header('Location: '.$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo '<h2>Не удалось удалить. Объявление ' . $del_id . ' не найдено.</h2>';
        echo '<h2><a href="' . $_SERVER['PHP_SELF'] . '">Назад<a></h2>';
        exit;
    }
}
//          print_r($ads);

require( 'dz7_html.php' );
?>
