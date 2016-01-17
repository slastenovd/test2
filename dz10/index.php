<?php
/*
 * Следующие задания требуется воспринимать как ТЗ (Техническое задание)
 * p.s. Разработчик, помни! 
 * Лучше уточнить ТЗ перед выполнением у заказчика, если ты что-то не понял, чем сделать, переделать, потерять время, деньги, нервы, репутацию.
 * Не забывай о навыках коммуникации :)
 * 
 * Задание dz9.php (mysqli) переделать с помощью DbSimple, все запросы к БД должны выводиться отладочным механизмом через FirePHP и видны в консоли Firebug

 */
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
//header("Content-Type: text/html; charset=utf-8");

require_once "FirePHPCore/FirePHP.class.php";
require_once "dbsimple/DbSimple/Generic.php";
require_once "dbsimple/config.php";
require_once "functions.php";

//$db = DbSimple_Generic::connect("mysqli://test:123@localhost/test");

$firePHP = FirePHP::getInstance(true);
$firePHP->setEnabled(true);

$ad_flag = 0;        // 0-новое, 1-исправление, 2-просмотр
$ads     = array();  // Массив объявлений
$ad      = array();  // Массив с объявлением для отображения
$err_msg = false;
$ini_file_name = 'db.ini';

if (! $ini_array = get_params_from_ini_file($ini_file_name) ){
    echo 'Отсутствует '.$ini_file_name.' файл. Перейдите к <a href="install.php">установке</a>';
    exit;
}

$db = DbSimple_Generic::connect('mysqli://'.$ini_array['UserName'].':'.$ini_array['Password'].'@'.$ini_array['ServerName'].'/'.$ini_array['Database']);
$db->setErrorHandler('databaseErrorHandler');
$db->setLogger('myLogger');

$cities = get_cities($db);             // Загрузка данных для селектора "Города"
$metro_stations = get_metro($db);      // Загрузка данных для селектора "Метро"
$categories = get_categories($db); // Загрузка данных для селектора "Категории"
$msg_ad_status = '';                   // Информационная строка, которая будет выводиться перед формой, и будет уведомлять пользователя о том сохранено ли его объявление

if (isset($_POST['seller_name'])) {    // Кнопка 'Отправить' нажата?
    $post = $_POST;        
    $err_msg = ad_check_n_view_errors($post);
//    print_r($err_msg);
    if ($err_msg) {                    // Заполнены ли все необходимые поля?
//    print_r($_POST);
//        $ad = $_POST;        
//        print_r($ad);
//        $post = $_POST;        
        $ad_flag = 1;                  // Установка флага в значение 1: не заполнены нужные поля, пользователь должен внести все необходимые данные
    } else {
//        $msg_ad_status = 'Объявление ' . trim(htmlspecialchars($post['title'])) . ' за ' . (int) $post['price'] . ' руб.';
        if ( !isset($post['allow_mails']) ) $post['allow_mails'] = 0; // Если чекбокс не нажат то в POST не отправляется никакого значения. В этом случае установка значения в 0
        if (isset($post['ad_id']) and $post['ad_id'] >= 0) { // Внесение изменений в существующее объявление
            update_ad($post, $db);
            $msg_ad_status .= ' сохранено';
        } else { // Добавление нового объявления
            insert_ad($post, $db);
            $msg_ad_status .= ' добавлено';
        }
        header('Location: '. $_SERVER['PHP_SELF']);
        exit();
    }
} elseif (isset($_GET['del_id'])) { // Удаление объявления
    delete_ad($_GET['del_id'], $db);
    header('Location: '. $_SERVER['PHP_SELF']);
} elseif (isset($_GET['id'])) { // Показать объявление
        $ad = get_ad($_GET['id'], $db);
        if( $ad ){
            $ad_flag = 2;
        } else {
            $msg_ad_status .= 'Не удалось отобразить объявление ' . (int) $_GET['id'];
        }
}

// Загрузка объявлений в массив для вывода на странице в виде таблицы
$ads = get_ads($db);

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
$smarty->assign('categories',$categories);
$smarty->assign('href_self',$_SERVER['PHP_SELF']);
$smarty->assign('ad',$ad);
$smarty->assign('msg_ad_status',$msg_ad_status);

$smarty->display('index.tpl');
?>
