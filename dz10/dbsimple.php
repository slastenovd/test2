<?php

/*
 * Следующие задания требуется воспринимать как ТЗ (Техническое задание)
 * p.s. Разработчик, помни! 
 * Лучше уточнить ТЗ перед выполнением у заказчика, если ты что-то не понял, чем сделать, переделать, потерять время, деньги, нервы, репутацию.
 * Не забывай о навыках коммуникации :)
 * 
 * Задание dz9.php (mysqli) переделать с помощью DbSimple, все запросы к БД должны выводиться отладочным механизмом через FirePHP и видны в консоли Firebug

 */
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

$ini_file_name = 'dz9.ini';


require_once "FirePHPCore/FirePHP.class.php";
require_once "dbsimple/DbSimple/Generic.php";
require_once "dbsimple/config.php";
require_once "functions.php";

$firePHP = FirePHP::getInstance(true);
$firePHP->setEnabled(true);

// Устанавливаем соединение.
//$db = DbSimple_Generic::connect("mysqli://test:123@localhost/test");
// Устанавливаем обработчик ошибок.

//$firePHP->table('ads', $db->select("SELECT * FROM ads "));

if (! $ini_array = get_params_from_ini_file($ini_file_name) ){
    echo 'Отсутствует '.$ini_file_name.' файл. Перейдите к <a href="install.php">установке</a>';
//    $mysqli->close();
    exit;
}
$db = DbSimple_Generic::connect('mysqli://'.$ini_array['UserName'].':'.$ini_array['Password'].'@'.$ini_array['ServerName'].'/'.$ini_array['Database']);
$db->setErrorHandler('databaseErrorHandler');
$db->setLogger('myLogger');

$cities = get_cities($db);             // Загрузка данных для селектора "Города"
$metro_stations = get_metro($db);      // Загрузка данных для селектора "Метро"
$subcategory = get_subcategories($db); // Загрузка данных для селектора "Категории"

update_ad(array('ad_id'=>1,'seller_name'=>'Дмитрий'),$db);
insert_ad(array('seller_name'=>'Obama','manager'=>'Psaki'),$db);

$firePHP->table('ads', $db->select("SELECT * FROM ads "));
//echo $db->mysqli->affected_rows;

////print_r($cities);
//print_r($metro_stations);
//print_r($subcategory);
// Код обработчика ошибок SQL.
//function databaseErrorHandler($message, $info)
//{
//    // Если использовалась @, ничего не делать.
//    if (!error_reporting()) return;
//    // Выводим подробную информацию об ошибке.
//    echo "SQL Error: $message<br><pre>"; 
//    print_r($info);
//    echo "</pre>";
//    exit();
//}
//
//function myLogger($db, $sql, $caller) {
//    global $firePHP;
//    if (isset($caller['file']))  $firePHP->group("at " . @$caller['file'] . 'line' . @$caller['line']);
//    $firePHP->log($sql);
//    $firePHP->groupEnd();
//}
//function get_params_from_ini_file($ini_file_name) {
//    $ini_array = array();
//    if ( file_exists($ini_file_name) ) {
//        foreach (explode(';', file_get_contents($ini_file_name)) as $value) {
//            $ini_array[trim(substr($value, 0, strpos($value, '=')))] = trim(substr($value, strpos($value, '=') + 1));
//        }
//    } else{
//        return false;
//    }
//    return $ini_array;
//}