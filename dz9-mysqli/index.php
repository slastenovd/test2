<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

$ad_flag = 0;        // 0-новое, 1-исправление, 2-просмотр
$ads     = array();  // Массив объявлений
$ad      = array();  // Массив с объявлением для отображения
$err_msg = false;
$ini_file_name = 'dz9.ini';

require( 'functions.php' ); 

$ini_array = array();
if (file_exists($ini_file_name)) {
    foreach (explode(';', file_get_contents($ini_file_name)) as $value) {
            $ini_array[trim(substr($value, 0, strpos($value,'=')))]=trim(substr($value, strpos($value,'=')+1));
    }
}

$mysqli = new mysqli($ini_array['ServerName'], $ini_array['UserName'],$ini_array['Password']); 

if (mysqli_connect_errno()) { 
    echo 'Невозможно установить соединение. Перейдите к <a href="install.php">установке</a>';
    $mysqli->close();
    exit;
} 

if ( !$mysqli->select_db($ini_array['Database']) ){
    echo 'БД не найдена. Перейдите к <a href="install.php">установке</a>';
    $mysqli->close();
    exit;
}

$ini_string = 'SET NAMES utf8';
if ( !$mysqli->query($ini_string) ){
    die('Ошибка при выполении инструкции. '.$ini_string.' '.mysqli_connect_error()); 
    
}

$cities = get_cities($mysqli);             // Загрузка данных для селектора "Города"
$metro_stations = get_metro($mysqli);      // Загрузка данных для селектора "Метро"
$subcategory = get_subcategories($mysqli); // Загрузка данных для селектора "Категории"
$msg_ad_status = '';                // Информационная строка, которая будет выводиться перед формой, и будет уведомлять пользователя о том сохранено ли его объявление

if (isset($_POST['seller_name'])) { // Кнопка 'Отправить' нажата?
    $err_msg = ad_check_n_view_errors();
    if ($err_msg) {                 // Заполнены ли все необходимые поля?
        $ad = $_POST;        
        $ad_flag = 1;               // Установка флага в значение 1: не заполнены нужные поля, пользователь должен внести все необходимые данные
    } else {
        $post = escape_POST($mysqli);
        if ( !isset($post['allow_mails']) ) $post['allow_mails'] = 0; // Если чекбокс не нажат то в POST не отправляется никакого значения. В этом случае установка значения в 0
        $msg_ad_status = 'Объявление ' . trim(htmlspecialchars($post['title'])) . ' за ' . (int) $post['price'] . ' руб.';
        if (isset($post['ad_id']) and $post['ad_id'] >= 0) { // Внесение изменений в существующее объявление
            update_ad($post, $mysqli);
            $msg_ad_status .= ' сохранено';
        } else { // Добавление нового объявления
            insert_ad($post, $mysqli);
            $msg_ad_status .= ' добавлено';
        }
        header('Location: '. $_SERVER['PHP_SELF']);
        exit();
    }
    
} elseif (isset($_GET['del_id'])) { // Удаление объявления
    if( delete_ad((int) $_GET['del_id'], $mysqli) === 1 ){
        header('Location: '. $_SERVER['PHP_SELF']);
        exit();
    } else{
        echo '<h2>Не удалось удалить. Объявление ' . (int)$_GET['del_id'] . ' не найдено.</h2>';
        echo '<h2><a href="' . $_SERVER['PHP_SELF'] . '">Назад<a></h2>';
        exit;
    }
} elseif (isset($_GET['id'])) { // Показать объявление
        $ad = get_ad((int) $_GET['id'], $mysqli);
        if( $ad ){
            $ad_flag = 2;
        } else {
            $msg_ad_status .= 'Не удалось отобразить объявление ' . (int) $_GET['id'];
        }
}

// Загрузка объявлений в массив для вывода на странице в виде таблицы
$ads = get_ads($mysqli);

$mysqli->close();   // Закрытие соединения с mysql       
$smarty_dir='smarty/';
require($smarty_dir.'/libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->compile_check = true;
//$smarty->debugging = true;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$smarty->assign('ads',$ads);
$smarty->assign('err_msg',$err_msg);
$smarty->assign('ad_flag',$ad_flag);
$smarty->assign('cities',$cities);
$smarty->assign('metro_stations',$metro_stations);
$smarty->assign('subcategory',$subcategory);
$smarty->assign('href_self',$_SERVER['PHP_SELF']);
$smarty->assign('ad',$ad);
$smarty->assign('msg_ad_status',$msg_ad_status);

$smarty->display('index.tpl');
?>