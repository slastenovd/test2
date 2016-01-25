<?php
// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info)
{
    // Если использовалась @, ничего не делать.
    if (!error_reporting()) return;
    // Выводим подробную информацию об ошибке.
    if ( isset($info['code']) and ($info['code'] === 1044 or $info['code'] === 1045 or $info['code'] === 1049 or $info['code'] === 2005)) {
        // 1045 Access denied 
        // 1044 Access denied 
        // 2005 Unknown MySQL server host 'localhost1' (34)        
        echo 'Невозможно подключиться к БД. Перейдите к <a href="install.php">установке</a><br>';
    }

    echo "SQL Error: $message<br><pre>"; 
    print_r($info);
    echo "</pre>";
    exit();
}

function myLogger($db, $sql, $caller) {
//    global $firePHP;
//    if (isset($caller['file']))  $firePHP->group("at " . @$caller['file'] . 'line' . @$caller['line']);
//    $firePHP->log($sql);
//    $firePHP->groupEnd();
}

spl_autoload_register(function ($class) { // автолоадер для классов 
    $class_file_name = MY_CLASSES_DIR. $class . '.class.php';
    if ( ! class_exists($class) and file_exists($class_file_name) ) {
        require $class_file_name;
    }
});

function getParamsFromIniFile($ini_file_name) { // Возвращает ассоциативный массив с параметрами подключения к БД
    $ini_array = array();
    if ( file_exists($ini_file_name) ) {
        foreach (explode(';', file_get_contents($ini_file_name)) as $value) {
            $ini_array[trim(substr($value, 0, strpos($value, '=')))] = trim(substr($value, strpos($value, '=') + 1));
        }
        return $ini_array;
    } else{
        return false;
    }
}

?>