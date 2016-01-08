<?php
function AD_show() { // Выводит перечень всех объявлений
    global $ads;
    $AD_show_result = '';
    if (count($ads)) {
        $row_counter = 1;
        $AD_show_result .= '<table class="table table-striped"><tr><td>#</td><td>Дата</td><td>Название</td><td>Цена</td><td>Имя</td><td>Телефон</td><td>Действие</td></tr>';
        foreach ($ads as $key => $value) {
            $AD_show_result .= '<tr><td>' . $row_counter++ . '</td><td>' . trim(date('D, d M Y H:i:s', (int) $value['date_change'])) . '</td><td><a href="' . $_SERVER[PHP_SELF] . '?id=' . (int) $key . '">' . $value['title'] . '</a></td><td>' . (int) $value['price'] . ' руб.</td><td>' . $value['seller_name'] . '</td><td>' . $value['phone'] . '</td><td><a href="' . $_SERVER[PHP_SELF] . '?del_id=' . (int) $key . '">удалить</a></td></tr>';
        }
        $AD_show_result .= '</table>';
    }
    return $AD_show_result;
}

function AD_check_n_view_errors() { // Проверяем заполнены ли все необходимые поля
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
        $error_msg .=  '<h4>Пожалуйста, заполните необходимые поля</h4><br>';
        return $error_msg;
    }else{
        return false;
    }
    return $error_flag;
}

function get_value($value) { // Получаем значение поля (в зависимости от режима из POST или из COOKIE
    global $AD_flag;
    global $ads;
    if ($AD_flag == 1 and isset($_POST[$value])) {
        return htmlspecialchars($_POST[$value]); // Режим дозаполнения полей
    }
    if ($AD_flag == 2 and isset($_GET['id']) and isset($ads[$_GET['id']][$value])) {
        return htmlspecialchars($ads[(int) $_GET['id']][(string) $value]); // Режим просмотра
    }
    return ''; // Режим ввода нового
}


function send_ads_in_file() {
    global $ads;
    file_put_contents("ads.dat", serialize($ads));
}

function receive_ads_from_file() {
    global $ads;
    if( file_exists ("ads.dat") ){
        $ads = unserialize(file_get_contents("ads.dat"));
    }
}

?>