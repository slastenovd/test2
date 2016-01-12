<?php 

$mysqli = new mysqli('localhost', 'test', '123'); 

if (mysqli_connect_errno()) { 
   echo 'Подключение к серверу MySQL невозможно. '. mysqli_connect_error(); 
   exit; 
} 

 if ( !$mysqli->query('SET NAMES utf8') ){
   echo 'Ошибка при выполении инструкции. '. mysqli_connect_error(); 
   exit; 
 }

 $result = $mysqli->query('SELECT * FROM ads');
 if ( !$result ){
   echo 'Ошибка при выполении инструкции. SELECT * FROM ads'. mysqli_connect_error(); 
   exit; 
 }

 while( $row = $result->fetch_assoc() ){ 
        echo $row['title'] .' '. $row['price'].'<br>'; 
    } 

    /* Освобождаем память */ 
    $result->close(); 


/* Закрываем соединение */ 
$mysqli->close(); 
?> 