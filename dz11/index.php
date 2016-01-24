<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);

require_once "settings.php";
require_once "functions.php";
require_once "FirePHPCore/FirePHP.class.php";
require_once MY_DBSIMPLE_DIR."DbSimple/Generic.php";
require_once MY_DBSIMPLE_DIR."config.php";
require_once MY_SMARTY_DIR.'/libs/Smarty.class.php';

$firePHP = FirePHP::getInstance(true);
$firePHP->setEnabled(true);

$smarty = new Smarty();
$smarty->compile_check = true;
//$smarty->debugging = true;

$smarty->template_dir = MY_SMARTY_DIR.'templates';
$smarty->compile_dir = MY_SMARTY_DIR.'templates_c';
$smarty->cache_dir = MY_SMARTY_DIR.'cache';
$smarty->config_dir = MY_SMARTY_DIR.'configs';

$Connect = new AdsDBConnect(INI_FILE_NAME);
$ads = new Ads($Connect);

if (isset($_POST['seller_name'])) {     // Кнопка 'Отправить' нажата?
    $ad = new Ad($_POST);
    $AdChecker = new AdChecker($ad);
    if ( $AdChecker->ErrorMessage ){    // Проверка на заполнение полей
        $ads->ShowForm($smarty, $ad, $AdChecker->ErrorMessage);            // Если не пройдена - на корректировку
    } else {
        $ads->SaveAd($ad);              // Иначе - сохранение
        $ads->ShowForm($smarty); 
    }
    
} elseif (isset($_GET['del_id'])) {     // Ссылка "удалить" нажата?
    
    $ads->delete_ad( $_GET['del_id'] );
    header('Location: '. $_SERVER['PHP_SELF']);
    
} elseif (isset($_GET['id'])) {         // Ссылка на объявление нажата?
    
    $ads->ShowForm( $smarty, $_GET['id'] ); 
    
} else {                                // Ничего не нажато - значит новое объявление
    
    $ads->ShowForm($smarty); 
    
}