<?php
  $ini_file_name = 'dz9.ini';
  
    if (file_exists($ini_file_name)) {
        $ini_array = array();
        foreach (explode(';', file_get_contents($ini_file_name)) as $value) {
            $ini_array[trim(substr($value, 0, strpos($value,'=')))]=trim(substr($value, strpos($value,'=')+1));
        }
//        print_r($ini_array);
echo $ini_array['ServerName'], $ini_array['UserName'],$ini_array['Password'];
        
        }
?>