<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);

require_once "settings.php";
require_once "class.php";

require_once(MY_SMARTY_DIR_CLASS_PHP);
$smarty = new Smarty();
$smarty->compile_check = true;
//$smarty->debugging = true;
$smarty->template_dir   = MY_SMARTY_DIR_TEMPLATES;
$smarty->compile_dir    = MY_SMARTY_DIR_TEMPLATES_C;
$smarty->cache_dir      = MY_SMARTY_DIR_CACHE;
$smarty->config_dir     = MY_SMARTY_DIR_CONFIGS;

$Connect = new adsDBConnect(INI_FILE_NAME);
$ads = new ads($Connect);

if (isset($_POST['seller_name'])) {     // Кнопка 'Отправить' нажата?
    
    $ad = new ad($_POST);
    $AdChecker = new AdChecker($ad);
    if ( $AdChecker->ErrorMessage ){    // Проверка на заполнение полей
        $ads->ShowForm($smarty, $ad, $AdChecker->ErrorMessage);            // Если не пройдена - на корректировку
    } else {
        $ads->SaveAd($smarty, $ad);              // Иначе - сохранение
        $ads->ShowForm(); 
    }
    
} elseif (isset($_GET['del_id'])) {     // Ссылка "удалить" нажата?
    
    $ads->delete_ad( $_GET['del_id'] );
    header('Location: '. $_SERVER['PHP_SELF']);
    
} elseif (isset($_GET['id'])) {         // Ссылка на объявление нажата?
    
    $ads->ShowForm( $smarty, $_GET['id'] ); 
    
} else {                                // Ничего не нажато - значит новое объявление
    
    $ads->ShowForm($smarty); 
    
}