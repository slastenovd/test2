<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

$ad_flag = 0;        // 0-новое, 1-исправление, 2-просмотр
$ads     = array();  // Массив объявлений
$ad      = array();  // Массив с объявлением для отображения
$err_msg = false;

$ad_fields = array(  // Перечень полей для внесения в БД
    'private', 
    'seller_name', 
    'manager', 
    'email', 
    'allow_mails', 
    'phone', 
    'location_id', 
    'metro_id', 
    'subcategory_id', 
    'title', 
    'description', 
    'price', 
    'date_change');

require( 'functions.php' ); 

$conn = mysql_connect('localhost', 'test','123') or die("Невозможно установить соединение: ". mysql_error());
mysql_select_db('test') or die("Невозможно подключиться к БД: ". mysql_error());

$ini_string = 'SET NAMES utf8';
mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());

// Загрузка данных для селектора "Города"
$ini_string = 'SELECT * FROM cities';
$result = mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());

while($row = mysql_fetch_assoc($result)){
    $citys[$row['city_id']] = $row['city_name'];
}

// Загрузка данных для селектора "Метро"
$ini_string = 'SELECT * FROM metro_stations';
$result = mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
while($row = mysql_fetch_assoc($result)){
    $metro_stations[$row['metro_station_id']] = $row['metro_station_name'];
}

// Загрузка данных для селектора "Категории"
$ini_string = 'SELECT category_name, subcategory_id, subcategory_name '
        . 'FROM categories '
        . 'left outer join subcategories '
        . 'on (categories.category_id = subcategories.category_id) '
        . 'order by subcategory_id';
$result = mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
while($row = mysql_fetch_assoc($result)){
    $subcategory[$row['category_name']][$row['subcategory_id']] = $row['subcategory_name'];
}

$msg_ad_status = ''; // Информационная строка, которая будет выводиться перед формой, и будет уведомлять пользователя о том сохранено ли его объявление

if (isset($_POST['seller_name'])) { // Кнопка 'Отправить' нажата?
    $err_msg = ad_check_n_view_errors();
    if ($err_msg) { // Заполнены ли все необходимые поля?
        $ad = $_POST;        
        $ad_flag = 1; // Установка флага в значение 1: не заполнены нужные поля, пользователь должен внести все необходимые данные
    } else {
        foreach ($_POST as $key => $value) { // В целях защиты от инъекций экранирование содержимого _POST и запись его в post[]
            $post[$key] = mysql_real_escape_string($value);
        }

        //$post['date_change'] = time(); // Добавление временной метки последнего внесения изменений в объявление
        $msg_ad_status = 'Объявление ' . trim(htmlspecialchars($post['title'])) . ' за ' . (int) $post['price'] . ' руб.';
        
        // Конструирование SQL инструкции
        $fields_for_insert = '';
        $values_for_insert = '';
        $values_for_update = '';
        
        foreach ($ad_fields as $key => $value) { // Проверка наличия необходимых полей
            $fields_for_insert .= $value;
            $values_for_update .= $value;
            if( isset($post[$value]) ){
                $values_for_insert .= "'".$post[$value]."'";
                $values_for_update .= " = '".$post[$value]."'";
            }
            else{
                if($value==='date_change'){
                    $values_for_insert .= "now()";
                    $values_for_update .= "=now()";
                }else{
                    $values_for_insert .= "''";
                    $values_for_update .= "=''";
                }
            }
            if( $key < (count($ad_fields)-1) ){
                $fields_for_insert .= ', ';
                $values_for_insert .= ', ';
                $values_for_update .= ', ';
            }
        }
//        $fields_for_insert .= 'date_change';
//        $values_for_insert .= 'now()';
//        $values_for_update .= ', date_change = now()';
        
        if (isset($post['ad_id']) and $post['ad_id'] >= 0) { // Внесение изменений в существующее объявление
            $ini_string = 'UPDATE ads SET '.$values_for_update.' WHERE ad_id = '.(int)$post['ad_id'];
            $msg_ad_status .= ' сохранено';
        } else { // Добавление нового объявления
            $ini_string = 'INSERT INTO ads ('.$fields_for_insert.') VALUES ('.$values_for_insert.')';
            $msg_ad_status .= ' добавлено';
        }
        mysql_query($ini_string) or die("Невозможно выполнить $ini_string запрос: ". mysql_error());
        header('Location: '. $_SERVER['PHP_SELF']);
        exit();
    }
    
} elseif (isset($_GET['del_id'])) { // Удаление объявления
    $del_id = (int) $_GET['del_id'];

    $ini_string = 'DELETE FROM ads WHERE ad_id = '.$del_id;
    mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
    if( mysql_affected_rows() === 1 ){
        header('Location: '. $_SERVER['PHP_SELF']);
        exit();
    }
    else{
        echo '<h2>Не удалось удалить. Объявление ' . $del_id . ' не найдено.</h2>';
        echo '<h2><a href="' . $_SERVER['PHP_SELF'] . '">Назад<a></h2>';
        exit;
    }

} elseif (isset($_GET['id'])) { // Показать объявление
    $get_id = (int) $_GET['id'];
    $ini_string = 'SELECT * FROM ads WHERE ad_id = '.$get_id;
    $result = mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
    if( mysql_affected_rows() === 1 ){
            $ad = mysql_fetch_assoc($result);
            $ad_flag = 2;
    } else {
//        echo '<h2>Не удалось отобразить объявление ' . $get_id . '.</h2>';
        $msg_ad_status .= 'Не удалось отобразить объявление ' . $get_id;
    }
}
//if (strlen(trim($msg_ad_status)) > 0) {
//    echo "<h2>$msg_ad_status</h2>";
//}

// Загрузка объявлений в массив для вывода на странице в виде таблицы
$ini_string = 'SELECT ad_id, date_change, title, price, seller_name, phone '
        . 'FROM ads '
        . 'order by date_change desc';
$result = mysql_query($ini_string) or die("Невозможно выполнить запрос: ". mysql_error());
while($row = mysql_fetch_assoc($result)){
    foreach ($row as $key => $value) {
        $ads[$row['ad_id']][$key] = $value;
    }
}

//print_r($ads);
mysql_close($conn);  // Закрытие соединения с mysql       

$project_root=$_SERVER['DOCUMENT_ROOT'];
$smarty_dir=$project_root.'/dz9/smarty/';

require($smarty_dir.'/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
//$smarty->debugging = true;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$smarty->assign('ads',$ads);
$smarty->assign('err_msg',$err_msg);
$smarty->assign('ad_flag',$ad_flag);
$smarty->assign('citys',$citys);
$smarty->assign('metro_stations',$metro_stations);
$smarty->assign('subcategory',$subcategory);
$smarty->assign('href_self',$_SERVER['PHP_SELF']);
$smarty->assign('ad',$ad);
$smarty->assign('msg_ad_status',$msg_ad_status);

$smarty->display('index.tpl');
?>
