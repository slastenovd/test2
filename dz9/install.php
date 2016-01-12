<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

if (isset($_POST['ServerName'])) { // Кнопка нажата?
    $mysqli = new mysqli($_POST['ServerName'], $_POST['UserName'], $_POST['Password']); 

    if (mysqli_connect_errno()) { 
        die('Подключение к серверу MySQL невозможно. '. mysqli_connect_error()); 
        exit; 
    } 

    if (file_exists("install.sql")) {
        $ini_string = file_get_contents("install.sql");
        $ini_array = explode(';', $ini_string);
        foreach ($ini_array as $value) {
            if ( !$mysqli->query($value) ){
               die('Ошибка при выполении инструкции. '.$value.' '.mysqli_connect_error()); 
               exit; 
            }
        }
        echo 'Успешно. Перейти к <a href="index.php">объявлениям.</a>';
    } else {
        die("Отсутствует файл дампа install.sql");
    }
     $mysqli->close(); 


/*
    $conn = mysql_connect($_POST['ServerName'], $_POST['UserName'], $_POST['Password']) or die("Невозможно установить соединение: " . mysql_error());

    $ini_string = 'SET NAMES utf8';
    mysql_query($ini_string) or die("Невозможно выполнить запрос: " . mysql_error());

    if (file_exists("install.sql")) {
        $ini_string = file_get_contents("install.sql");
        $ini_array = explode(';', $ini_string);
        foreach ($ini_array as $value) {
            mysql_query($value) or die("Невозможно выполнить установку БД: " . mysql_error());
        }
        echo 'Успешно. Перейти к <a href="index.php">объявлениям.</a>';
    } else {
        die("Отсутствует файл дампа install.sql");
    }

    mysql_close($conn);  // Закрытие соединения с mysql       
 * 
 */
} else {

    $project_root = $_SERVER['DOCUMENT_ROOT'];
    $smarty_dir = $project_root . '/dz9/smarty/';

    require($smarty_dir . '/libs/Smarty.class.php');
    $smarty = new Smarty();

    $smarty->compile_check = true;
//$smarty->debugging = true;

    $smarty->template_dir = $smarty_dir . 'templates';
    $smarty->compile_dir = $smarty_dir . 'templates_c';
    $smarty->cache_dir = $smarty_dir . 'cache';
    $smarty->config_dir = $smarty_dir . 'configs';

//$smarty->assign('ads',$ads);

    $smarty->display('install.tpl');
}
?>
