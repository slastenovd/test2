<?php

class AdChecker { // Сервисный класс - проверяет ad на ошибки
    public static function check($ad) {
        $CheckResult = false;
        if( ($ad instanceof Ads) or ($ad instanceof AdsCompany) or ($ad instanceof AdsPrivatePerson) ){ // Если в качестве параметра передано объявление 
            if ( !strlen($ad->getTitle()) ) { // Если значение не приянто, или принято пустое
                $CheckResult .= 'Не заполнено поле Название объявления<br>';
            }

            if ( !strlen($ad->getSeller_name()) )  {  // Если значение не приянто, или принято пустое
                $CheckResult .= 'Не заполнено поле Ваше имя<br>';
            }

            if ( $ad->getPrice() == 0 ) {// Если значение не приянто, или принято пустое
                $CheckResult .= 'Не заполнено поле Цена<br>';
            }
        }
        return $CheckResult;
    }
}

?>