<?php
require_once "prepare.php";

$adStore =  AdsStore::instance()->getAllAdsFromDb();

if (isset($_POST['seller_name']) and isset($_POST['price'])) {     // Кнопка 'Отправить' нажата?
    if( $_POST['private'] ){
        $ad = new AdsCompany($_POST);    
    }else{
        $ad = new AdsPrivatePerson($_POST);    
    }
    $CheckResult = AdChecker::check($ad);
    if ( $CheckResult ){    // Проверка на заполнение полей
        $adStore->prepareForOut($ad, $CheckResult); // Если не пройдена - на корректировку
    } else {
        $ad->save();              // Иначе - сохранение
        $adStore->prepareForOut(); // Если не пройдена - на корректировку
    }
} elseif (isset($_GET['id'])) {         // Ссылка на объявление нажата?
    $adStore->prepareForOut($_GET['id']); // Если не пройдена - на корректировку
} else {                                // Ничего не нажато - значит новое объявление
    $adStore->prepareForOut(); // Если не пройдена - на корректировку
}

$adStore->display(); // Если не пройдена - на корректировку
