<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

if (isset($_POST['ServerName'])) { // Кнопка нажата?
    $conn = mysql_connect($_POST['ServerName'], $_POST['UserName'], $_POST['Password']) or die("Невозможно установить соединение: " . mysql_error());
    $ini_string = 'SET NAMES utf8';
    mysql_query($ini_string) or die("Невозможно выполнить запрос: " . mysql_error());
    if (file_exists("install.sql")) {
        $ini_string = file_get_contents("install.sql");
        $ini_string = str_replace('%database_name%', $_POST['Database'], $ini_string);
        $ini_array = explode(';', $ini_string);
        foreach ($ini_array as $value) {
            mysql_query($value) or die("Невозможно выполнить установку БД: " . mysql_error());
        }
        echo 'Успешно. Перейти к <a href="index.php">объявлениям.</a>';
    } else {
        die("Отсутствует файл дампа install.sql");
    }
    mysql_close($conn);  // Закрытие соединения с mysql       
} else {
    $project_root = $_SERVER['DOCUMENT_ROOT'];
    $smarty_dir = $project_root . '/dz9/smarty/';
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
