<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");
$ini_file_name = 'db.ini';
$dump_file_name = 'install.sql';


if (isset($_POST['ServerName'])) { // Кнопка нажата?
    $mysqli = new mysqli($_POST['ServerName'], $_POST['UserName'], $_POST['Password']); 

    if (mysqli_connect_errno()) { 
        die('Подключение к серверу MySQL невозможно. '. mysqli_connect_error()); 
    } 

    if (file_exists("install.sql")) {
        $ini_string = file_get_contents($dump_file_name);
        $ini_string = str_replace('%database_name%', $_POST['Database'], $ini_string);
        $ini_array = explode(';', $ini_string);
        foreach ($ini_array as $value) {
            if ( !$mysqli->query($value) ){
               die('Ошибка при выполении инструкции. '.$value.' '.mysqli_connect_error()); 
            }
        }
        // Конфигурация - в файл
        $str_post = '';
        foreach($_POST as $key => $val)
        {
           $str_post .= $key.'='.$val."; \n";
        }
        if( !file_put_contents($ini_file_name, $str_post) ){ echo "Ошибка создания конфигурационного файла"; exit; }
        echo 'Успешно. Перейти к <a href="index.php">объявлениям.</a>';
    } else {
        die("Отсутствует файл дампа install.sql");
    }
    $mysqli->close(); // Закрытие соединения с mysql       
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
