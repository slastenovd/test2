<?php
function ad_check_n_view_errors() { // Проверяем заполнены ли все необходимые поля
//    $error_flag = false;
    $error_msg = false;
    if (isset($_POST['title']) and ! strlen($_POST['title'])) { // Если значение приянто, однако оно пустое
        $error_msg .= '<label> Не заполнено поле Название объявления</label><br>';
//        $error_flag = true;
    }

    if (isset($_POST['seller_name']) and ! strlen($_POST['seller_name'])) { // Если значение приянто, однако оно пустое
        $error_msg .= '<label> Не заполнено поле Ваше имя</label><br>';
//        $error_flag = true;
    }

    if (isset($_POST['price']) and $_POST['price'] == 0) { // Если значение приянто, однако оно пустое
        $error_msg .= '<label> Не заполнено поле Цена</label><br>';
//        $error_flag = true;
    }
//    if (strlen($error_msg)) {
////        $error_msg .=  '<label>Пожалуйста, заполните необходимые поля</label><br>';
//        return $error_msg;
//    }else{
//        return false;
//    }
    return $error_msg;
} 

function get_cities($db){ // Загрузка данных для селектора "Города"
    return $db->selectCol("SELECT city_id AS ARRAY_KEY, city_name FROM cities ");
}

function get_metro($db){
    return $db->selectCol("SELECT metro_station_id  AS ARRAY_KEY, metro_station_name FROM metro_stations");
}

function get_subcategories($db){ // Загрузка данных для селектора "Категории"
    
    $ini_string = 'SELECT category_name as ARRAY_KEY_1, subcategory_id ARRAY_KEY_2, subcategory_name '
            . 'FROM categories '
            . 'left join subcategories '
            . 'on (categories.category_id = subcategories.category_id) '
            . 'order by subcategory_id';
    return $db->selectCol($ini_string);
    
}

//function escape_POST($mysqli){ // В целях защиты от инъекций экранирование содержимого _POST и запись его в post[]
//        $post = array();
//        foreach ($_POST as $key => $value) { 
//            $post[$mysqli->real_escape_string($key)] = $mysqli->real_escape_string($value);
//        }
//        return $post;
//}

function update_ad($post, $db){
    $db->query('UPDATE ads SET ?a WHERE ad_id=?',$post,$post['ad_id']);
}
function insert_ad($post, $db){
    $db->query('INSERT ads SET ?a',$post);
//    
//    $columns = join(", ",array_keys($bd));//получаем строку ключей
//    $values  = join("', '",array_values($bd)); // получаем строку значений
//    $sql = "INSERT INTO ads ($columns) VALUES ('$values')";    
//    $mysqli->query($sql) or die("Невозможно выполнить $sql запрос: ". mysql_error());
}

function delete_ad($del_id, $db){
    $db->query('DELETE FROM ads WHERE ad_id = ?',$del_id);

//    $ini_string = 'DELETE FROM ads WHERE ad_id = '.$del_id;
//    $mysqli->query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
//    return $mysqli->affected_rows;
}

function get_ad($ad_id, $db){
    return $db->select('SELECT * FROM ads WHERE ad_id = ?',$ad_id);

//    $ini_string = 'SELECT * FROM ads WHERE ad_id = '.$ad_id;
//    $result = $mysqli->query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
//    if( $mysqli->affected_rows === 1 ){
//        return mysqli_fetch_assoc($result);
//    } else {
//        return false;
//    }
}

function get_ads($db){    // Загрузка объявлений в массив для вывода на странице в виде таблицы
    $ini_string = 'SELECT ad_id as ARRAY_KEY, date_change, title, price, seller_name, phone '
            . 'FROM ads '
            . 'order by date_change desc';
    return $db->select($ini_string);
//
//
//
//    $result = $mysqli->query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
//    $ads = array();
//    
//    while($row = mysqli_fetch_assoc($result)){
//        foreach ($row as $key => $value) {
//            $ads[$row['ad_id']][$key] = $value;
//        }
//    }
//    return $ads;
}

// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info)
{
    // Если использовалась @, ничего не делать.
    if (!error_reporting()) return;
    // Выводим подробную информацию об ошибке.
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