<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

require_once "settings.php";

if (isset($_POST['ServerName'])) { // Кнопка нажата?
    $mysqli = new mysqli($_POST['ServerName'], $_POST['UserName'], $_POST['Password']); 

    if (mysqli_connect_errno()) { 
        die('Подключение к серверу MySQL невозможно. '. mysqli_connect_error()); 
    } 

    if (file_exists(DUMP_FILE_NAME)) {
        $ini_string = str_replace('%database_name%', $_POST['Database'], file_get_contents(DUMP_FILE_NAME));
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
        if( !file_put_contents(INI_FILE_NAME, $str_post) ){ echo "Ошибка создания конфигурационного файла"; exit; }
        echo 'Успешно. Перейти к <a href="index.php">объявлениям.</a>';
    } else {
        die("Отсутствует файл дампа ".DUMP_FILE_NAME);
    }
    $mysqli->close(); // Закрытие соединения с mysql       
} else {
    
    require(MY_SMARTY_DIR . '/libs/Smarty.class.php');
    $smarty = new Smarty();
    $smarty->compile_check = true;
    $smarty->template_dir = MY_SMARTY_DIR . 'templates';
    $smarty->compile_dir = MY_SMARTY_DIR . 'templates_c';
    $smarty->cache_dir = MY_SMARTY_DIR . 'cache';
    $smarty->config_dir = MY_SMARTY_DIR . 'configs';
    $smarty->display('install.tpl');
}
?>
