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


function get_cities(){// Загрузка данных для селектора "Города"
    $ini_string = 'SELECT * FROM cities';
    $result = mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
    $cities = array();
    while($row = mysql_fetch_assoc($result)){
            $cities[$row['city_id']] = $row['city_name'];
        }
    return $cities;
}

function get_metro(){
    $ini_string = 'SELECT * FROM metro_stations';
    $result = mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
    $metro_stations = array();
    while($row = mysql_fetch_assoc($result)){
        $metro_stations[$row['metro_station_id']] = $row['metro_station_name'];
    }
    
    return $metro_stations;
}


function get_subcategories(){ // Загрузка данных для селектора "Категории"
    
    $ini_string = 'SELECT category_name, subcategory_id, subcategory_name '
            . 'FROM categories '
            . 'left outer join subcategories '
            . 'on (categories.category_id = subcategories.category_id) '
            . 'order by subcategory_id';
    $result = mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
    $subcategories = array();
    while($row = mysql_fetch_assoc($result)){
        $subcategories[$row['category_name']][$row['subcategory_id']] = $row['subcategory_name'];
    }
    return $subcategories;
}

function escape_POST(){ // В целях защиты от инъекций экранирование содержимого _POST и запись его в post[]
        $post = array();
        foreach ($_POST as $key => $value) { 
            $post[mysql_real_escape_string($key)] = mysql_real_escape_string($value);
        }
        return $post;
}

function update_ad($bd){
    //создаем строку запроса
        $data_update = '';
        foreach ($bd as $key => $value) {
            $data_update .= "$key='$value', ";
        }
        $data_update = substr($data_update, 0, -2); //убираем лишний пробел и запятую
        $sql = "UPDATE ads SET $data_update WHERE ad_id='".$bd['ad_id']."'";
        mysql_query($sql) or die("Невозможно выполнить $sql запрос: ". mysql_error());
}
function insert_ad($bd){
    $columns = join(", ",array_keys($bd));//получаем строку ключей
    $values  = join("', '",array_values($bd)); // получаем строку значений
    $sql = "INSERT INTO ads ($columns) VALUES ('$values')";    
    mysql_query($sql) or die("Невозможно выполнить $sql запрос: ". mysql_error());
}

function delete_ad($del_id){
    $ini_string = 'DELETE FROM ads WHERE ad_id = '.$del_id;
    mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
    return mysql_affected_rows();
}

function get_ad($ad_id){
    $ini_string = 'SELECT * FROM ads WHERE ad_id = '.$ad_id;
    $result = mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
    if( mysql_affected_rows() === 1 ){
        return mysql_fetch_assoc($result);
    } else {
        return false;
    }
}

function get_ads(){    // Загрузка объявлений в массив для вывода на странице в виде таблицы
    $ini_string = 'SELECT ad_id, date_change, title, price, seller_name, phone '
            . 'FROM ads '
            . 'order by date_change desc';
    $result = mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
    $ads = array();
    
    while($row = mysql_fetch_assoc($result)){
        foreach ($row as $key => $value) {
            $ads[$row['ad_id']][$key] = $value;
        }
    }
    return $ads;
}
?>