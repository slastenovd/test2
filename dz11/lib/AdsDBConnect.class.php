<?php

class AdsDBConnect {
    public $db;
    
    public function __construct($ini_file_name) {
        if (! $ini_array = $this->get_params_from_ini_file($ini_file_name) ){
            echo 'Отсутствует '.$this->ini_file_name.' файл. Перейдите к <a href="install.php">установке</a>';
            exit;
        }
        $this->db = DbSimple_Generic::connect('mysqli://'.$ini_array['UserName'].':'.$ini_array['Password'].'@'.$ini_array['ServerName'].'/'.$ini_array['Database']);
        $this->db->setErrorHandler('databaseErrorHandler');
        $this->db->setLogger('myLogger');
    }
    
    private function get_params_from_ini_file($ini_file_name) { // Возвращает ассоциативный массив с параметрами подключения к БД
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
}

?>