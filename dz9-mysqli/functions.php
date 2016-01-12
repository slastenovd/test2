<?php
function ad_check_n_view_errors() { // Проверяем заполнены ли все необходимые поля
    $error_flag = false;
    $error_msg = '';
    if (isset($_POST['title']) and ! strlen($_POST['title'])) { // Если значение приянто, однако оно пустое
        $error_msg .= '<label> Не заполнено поле Название объявления</label><br>';
        $error_flag = true;
    }

    if (isset($_POST['seller_name']) and ! strlen($_POST['seller_name'])) { // Если значение приянто, однако оно пустое
        $error_msg .= '<label> Не заполнено поле Ваше имя</label><br>';
        $error_flag = true;
    }

    if (isset($_POST['price']) and $_POST['price'] == 0) { // Если значение приянто, однако оно пустое
        $error_msg .= '<label> Не заполнено поле Цена</label><br>';
        $error_flag = true;
    }
    if (strlen($error_msg)) {
//        $error_msg .=  '<label>Пожалуйста, заполните необходимые поля</label><br>';
        return $error_msg;
    }else{
        return false;
    }
    return $error_flag;
} 
?>