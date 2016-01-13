<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

if (isset($_POST['ServerName'])) { // Кнопка нажата?
    $mysqli = new mysqli($_POST['ServerName'], $_POST['UserName'], $_POST['Password']); 

    if (mysqli_connect_errno()) { 
        die('Подключение к серверу MySQL невозможно. '. mysqli_connect_error()); 
    } 

    if (file_exists("install.sql")) {
        $ini_string = file_get_contents("install.sql");
        $ini_string = str_replace('%database_name%', $_POST['Database'], $ini_string);
        $ini_array = explode(';', $ini_string);
        foreach ($ini_array as $value) {
            if ( !$mysqli->query($value) ){
               die('Ошибка при выполении инструкции. '.$value.' '.mysqli_connect_error()); 
            }
        }
        echo 'Успешно. Перейти к <a href="index.php">объявлениям.</a>';
    } else {
        die("Отсутствует файл дампа install.sql");
    }
     $mysqli->close(); 
} else {

    $smarty_dir='smarty/';
    require($smarty_dir . '/libs/Smarty.class.php');
    $smarty = new Smarty();
    $smarty->compile_check = true;
    $smarty->template_dir = $smarty_dir . 'templates';
    $smarty->compile_dir = $smarty_dir . 'templates_c';
    $smarty->cache_dir = $smarty_dir . 'cache';
    $smarty->config_dir = $smarty_dir . 'configs';
    $smarty->display('install.tpl');
}
?>
