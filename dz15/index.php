<?php
require_once "prepare.php";

AdsStore::instance()->getAllAdsFromDb();

if (isset($_POST['seller_name']) and isset($_POST['price'])) {     // Кнопка 'Отправить' нажата?
    if( $_POST['private'] ){
        $ad = new AdsCompany($_POST);    
    }else{
        $ad = new AdsPrivatePerson($_POST);    
    }
    $CheckResult = AdChecker::check($ad);
    if ( $CheckResult ){    // Проверка на заполнение полей
        AdsStore::instance()->prepareForOut($ad, $CheckResult); // Если не пройдена - на корректировку
    } else {
        $ad->save();              // Иначе - сохранение
        AdsStore::instance()->prepareForOut(); // Если не пройдена - на корректировку
    }
} elseif (isset($_GET['id'])) {         // Ссылка на объявление нажата?
    AdsStore::instance()->prepareForOut($_GET['id']); // Если не пройдена - на корректировку
} else {                                // Ничего не нажато - значит новое объявление
    AdsStore::instance()->prepareForOut(); // Если не пройдена - на корректировку
}

AdsStore::instance()->display(); // Если не пройдена - на корректировку
