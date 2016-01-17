<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

$ini_file_name = 'db.ini';

require_once "FirePHPCore/FirePHP.class.php";
require_once "dbsimple/DbSimple/Generic.php";
require_once "dbsimple/config.php";
require_once "functions.php";

$firePHP = FirePHP::getInstance(true);
$firePHP->setEnabled(true);

if (! $ini_array = get_params_from_ini_file($ini_file_name) ){
    echo 'Отсутствует '.$ini_file_name.' файл. Перейдите к <a href="install.php">установке</a>';
//    $mysqli->close();
    exit;
}
$db = DbSimple_Generic::connect('mysqli://'.$ini_array['UserName'].':'.$ini_array['Password'].'@'.$ini_array['ServerName'].'/'.$ini_array['Database']);
//$db = DbSimple_Generic::connect('mysqli://'.$ini_array['UserName'].':'.$ini_array['Password'].'@'.$ini_array['ServerName']);
$db->setErrorHandler('databaseErrorHandler');
$db->setLogger('myLogger');

$cities = get_cities($db);             // Загрузка данных для селектора "Города"
$metro_stations = get_metro($db);      // Загрузка данных для селектора "Метро"
$subcategory = get_categories($db); // Загрузка данных для селектора "Категории"
    
//update_ad(array('ad_id'=>1,'seller_name'=>'Дмитрий'),$db);
//insert_ad(array('seller_name'=>'Obama','manager'=>'Psaki'),$db);

$firePHP->table('ads', $db->select("SELECT * FROM ads "));
//print_r($subcategory);

$forest = $db->selectRow('SELECT category_id AS ARRAY_KEY_1, parent_id AS PARENT_KEY, category_id AS ARRAY_KEY_2, category_name FROM categories
s');

print_r($forest);
