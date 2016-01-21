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
    global $firePHP;
    if (isset($caller['file']))  $firePHP->group("at " . @$caller['file'] . 'line' . @$caller['line']);
    $firePHP->log($sql);
    $firePHP->groupEnd();
}

?>