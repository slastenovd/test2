<?php

class AdChecker { // Сервисный класс - проверяет ad на ошибки
    public $ErrorMessage = false;
    
    public function __construct($ad) {
        if( ($ad instanceof ad) ){ // Если в качестве параметра передано объявление 
            if ( ! isset($ad->title) or (isset($ad->title) and ! strlen($ad->title)) ) { // Если значение не приянто, или принято пустое
                $this->ErrorMessage .= 'Не заполнено поле Название объявления<br>';
            }

            if ( ! isset($ad->seller_name) or (isset($ad->seller_name) and ! strlen($ad->seller_name)) ) {  // Если значение не приянто, или принято пустое
                $this->ErrorMessage .= 'Не заполнено поле Ваше имя<br>';
            }

            if ( ! isset($ad->price) or (isset($ad->price) and $ad->price == 0) ) {// Если значение не приянто, или принято пустое
                $this->ErrorMessage .= 'Не заполнено поле Цена<br>';
            }
        }
    }
}

?>