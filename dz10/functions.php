<?php
function ad_check_n_view_errors($ad) { // Проверяем заполнены ли все необходимые поля
    $error_msg = false;
    if (isset($ad['title']) and ! strlen($ad['title'])) { // Если значение приянто, однако оно пустое
        $error_msg .= '<label> Не заполнено поле Название объявления</label><br>';
    }

    if (isset($ad['seller_name']) and ! strlen($ad['seller_name'])) { // Если значение приянто, однако оно пустое
        $error_msg .= '<label> Не заполнено поле Ваше имя</label><br>';
    }

    if (isset($ad['price']) and $ad['price'] == 0) { // Если значение приянто, однако оно пустое
        $error_msg .= '<label> Не заполнено поле Цена</label><br>';
    }
    return $error_msg;
} 


function update_ad($post, $db){
    $db->query('UPDATE ads SET ?a WHERE ad_id=?',$post,$post['ad_id']);
}
function insert_ad($post, $db){
    $db->query('INSERT ads SET ?a',$post);
}

function delete_ad($del_id, $db){
    $db->query('DELETE FROM ads WHERE ad_id = ?',$del_id);

}

//function get_ad($ad_id, $db){
//    return $db->selectRow('SELECT * FROM ads WHERE ad_id = ?',$ad_id);
//}
//
//function get_ads($db){    // Загрузка объявлений в массив для вывода на странице в виде таблицы
//    $ini_string = 'SELECT ad_id as ARRAY_KEY, date_change, title, price, seller_name, phone '
//            . 'FROM ads '
//            . 'order by date_change desc';
//    return $db->select($ini_string);
//}

// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info)
{
    // Если использовалась @, ничего не делать.
    if (!error_reporting()) return;
    // Выводим подробную информацию об ошибке.

//    global $firePHP;
//    $firePHP->log($message);
//    $firePHP->log($info);
    
    if ( isset($info['code']) and ($info['code'] === 1044 or $info['code'] === 1045 or $info['code'] === 1049 or $info['code'] === 2005)) {
        // 1045 Access denied 
        // 1044 Access denied 
        // 2005 Unknown MySQL server host 'localhost1' (34)        
        echo 'Невозможно подключиться к БД. Перейдите к <a href="install.php">установке</a><br>';
//        exit;
    }

    echo "SQL Error: $message<br><pre>"; 
    print_r($info);
    echo "</pre>";
    exit();
}

function myLogger($db, $sql, $caller) {
    global $firePHP;
    if (isset($caller['file']))  $firePHP->group("at " . @$caller['file'] . 'line' . @$caller['line']);
    $firePHP->log($sql);
    $firePHP->groupEnd();
}

?>