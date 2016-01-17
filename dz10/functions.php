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

function get_cities($db){ // Загрузка данных для селектора "Города"
    return $db->selectCol("SELECT city_id AS ARRAY_KEY, city_name FROM cities ");
}

function get_metro($db){
    return $db->selectCol("SELECT metro_station_id  AS ARRAY_KEY, metro_station_name FROM metro_stations");
}

function get_categories($db){ // Загрузка данных для селектора "Категории"
    
    $ini_string = 'SELECT a.category_name AS ARRAY_KEY_1, b.category_id AS ARRAY_KEY_2, b.category_name '
            . 'FROM categories a left join categories b on a.category_id = b.parent_id '
            . 'WHERE a.parent_id is NULL';
    return $db->selectCol($ini_string);
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

function get_ad($ad_id, $db){
    return $db->selectRow('SELECT * FROM ads WHERE ad_id = ?',$ad_id);
}

function get_ads($db){    // Загрузка объявлений в массив для вывода на странице в виде таблицы
    $ini_string = 'SELECT ad_id as ARRAY_KEY, date_change, title, price, seller_name, phone '
            . 'FROM ads '
            . 'order by date_change desc';
    return $db->select($ini_string);
}

// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info)
{
    // Если использовалась @, ничего не делать.
    if (!error_reporting()) return;
    // Выводим подробную информацию об ошибке.

//    global $firePHP;
//    $firePHP->log($message);
//    $firePHP->log($info);

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

function get_params_from_ini_file($ini_file_name) {
    $ini_array = array();
    if ( file_exists($ini_file_name) ) {
        foreach (explode(';', file_get_contents($ini_file_name)) as $value) {
            $ini_array[trim(substr($value, 0, strpos($value, '=')))] = trim(substr($value, strpos($value, '=') + 1));
        }
    } else{
        return false;
    }
    return $ini_array;
}
?>