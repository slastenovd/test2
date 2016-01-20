<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);

require_once "class.php";

$ads = new ads();

if (isset($_POST['seller_name'])) {     // Кнопка 'Отправить' нажата?
    
    $ad = new ad();
    $ad->ArrayToAd($_POST);
    if ( $ad->Check() ){                // Проверка на заполнение полей
        $ads->ShowForm($ad);            // Если не пройдена - на корректировку
    } else {
        $ads->SaveAd($ad);              // Иначе - сохранение
        $ads->ShowForm(); 
    }
    
} elseif (isset($_GET['del_id'])) {     // Ссылка "удалить" нажата?
    
    $ads->delete_ad( $_GET['del_id'] );
    header('Location: '. $_SERVER['PHP_SELF']);
    
} elseif (isset($_GET['id'])) {         // Ссылка на объявление нажата?
    
    $ads->ShowForm( $_GET['id'] ); 
    
} else {                                // Ничего не нажато - значит новое объявление
    
    $ads->ShowForm(); 
    
}