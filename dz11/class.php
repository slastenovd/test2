<?php

require_once "FirePHPCore/FirePHP.class.php";
require_once "dbsimple/DbSimple/Generic.php";
require_once "dbsimple/config.php";
require_once "functions.php";

$firePHP = FirePHP::getInstance(true);
$firePHP->setEnabled(true);

class ad {
//    public $ad_id;
//    public $private;
//    public $seller_name;
//    public $manager;
//    public $email;
//    public $allow_mails;
//    public $phone;
//    public $location_id;
//    public $metro_id;
//    public $category_id;
//    public $title;
//    public $description;
//    public $price;
//    public $date_change;
//    
    
    public function __construct($ad) {
        foreach($ad as $key => $value) {
            $this->$key = $value;
        }
        if ( !isset($ad_array['allow_mails']) )  $this->allow_mails = 0;
    }

    public function AdToArray(){
        $ad_array = Array();
        foreach($this as $key => $value) {
            $ad_array[$key] = $value;
        }        

        
        return $ad_array;
    }
}

class AdChecker { // Сервисный класс
    public $ErrorMessage = false;
    
    public function __construct($ad) {
        if( ($ad instanceof ad) ){ // Если в качестве параметра передано объявление 
            if ( ! isset($ad->title) or (isset($ad->title) and ! strlen($ad->title)) ) { // Если значение не приянто, или принято пустое
                $this->ErrorMessage .= 'Не заполнено поле Название объявления<br>';
            }

            if ( ! isset($ad->seller_name) or (isset($ad->seller_name) and ! strlen($ad->seller_name)) ) {  // Если значение не приянто, или принято пустое
                $this->ErrorMessage .= 'Не заполнено поле Ваше имя<br>';
            }

            if ( ! isset($ad->price) or (isset($ad->price) and $ad->price == 0) ) {// Если значение не приянто, или принято пустое
                $this->ErrorMessage .= 'Не заполнено поле Цена<br>';
            }
        }
    }
}

class ads {
    protected $ads = Array();
    protected $db;
    protected $ini_file_name = 'db.ini';

    function __construct() {
        $this->Connect();
//        $this->ReadFromDatabase();
    }
    public function Connect(){
        if (! $ini_array = $this->get_params_from_ini_file() ){
            echo 'Отсутствует '.$this->ini_file_name.' файл. Перейдите к <a href="install.php">установке</a>';
            exit;
        }
        $this->db = DbSimple_Generic::connect('mysqli://'.$ini_array['UserName'].':'.$ini_array['Password'].'@'.$ini_array['ServerName'].'/'.$ini_array['Database']);
        $this->db->setErrorHandler('databaseErrorHandler');
        $this->db->setLogger('myLogger');
        
    }

    public function SaveAd(ad $ad){ 
        if( isset($ad->ad_id) and $ad->ad_id ){
            $this->db->query('UPDATE ads SET ?a WHERE ad_id=?',$ad->AdToArray(),$ad->ad_id);
        }else{
            $this->db->query('INSERT ads SET ?a',$ad->AdToArray());
        }        
    }

    protected function ReadFromDatabase(){ // Считывает объявления из БД
        $ads_from_db = $this->db->select('SELECT * '
                . 'FROM ads '
                . 'order by date_change desc');
        unset ($this->ads);
        foreach ($ads_from_db as $key => $value) {
            $ad = new ad($value);
//            $ad->ArrayToAd($value);
            $this->ads[$ad->ad_id] = $ad;
        }
    }
    
    public function get_params_from_ini_file() { // Возвращает ассоциативный массив с параметрами подключения к БД
        $ini_array = array();
        if ( file_exists($this->ini_file_name) ) {
            foreach (explode(';', file_get_contents($this->ini_file_name)) as $value) {
                $ini_array[trim(substr($value, 0, strpos($value, '=')))] = trim(substr($value, strpos($value, '=') + 1));
            }
            return $ini_array;
        } else{
            return false;
        }
    }
    
    protected function GetCities(){ // Загрузка данных для селектора "Города"
        return $this->db->selectCol("SELECT city_id AS ARRAY_KEY, city_name FROM cities ");
    }

    protected function GetMetro(){
        return $this->db->selectCol("SELECT metro_station_id  AS ARRAY_KEY, metro_station_name FROM metro_stations");
    }

    protected function GetCategories(){ // Загрузка данных для селектора "Категории"

        return $this->db->selectCol('SELECT a.category_name AS ARRAY_KEY_1, b.category_id AS ARRAY_KEY_2, b.category_name '
                . 'FROM categories a left join categories b on a.category_id = b.parent_id '
                . 'WHERE a.parent_id is NULL');
    }
    
    protected function GetAdsArray(){ // Возвращает объявления в виде ассоциативного массива
        $ads = Array();
        if ( isset($this->ads) ) 
        foreach ($this->ads as $key => $value) {
//            $ads[$value->ad_id] = $value;
            $ads[$value->ad_id] = $value->AdToArray();
        }
        return $ads;
    }
    
    public function delete_ad($ad_id){
        $this->db->query('DELETE FROM ads WHERE ad_id = ?',(int)$ad_id);
        unset( $this->ads[$ad_id] );
        return $this->db->affected_rows;
    }

    public function ShowForm($param = -1, $ErrorMessage = false){ // Открывает web форму
        // $param = -1 Новое объявление
        // $param >= 0 Показать объявление
        // $param является объектом класса ad : отредактировать объявление
        
        $this->ReadFromDatabase();
//        $ad = Ar ray();
//        $err_msg = '';
        $ad_flag = 0;
//        $msg_ad_status = '';
        
        if( isset($param) and ($param instanceof ad) ){ // Если в качестве параметра передано объявление 
            $ad = $param;
//            $err_msg = $param->CheckResult;
            $ad_flag = 1;
        } elseif( isset($this->ads[(int)$param]) ){     // Если в качестве параметра передан номер объявления
            $ad = $this->ads[(int)$param]; 
            $ad_flag = 2;
        } else {
            $ad = new ad();
        }

        $smarty_dir='smarty/';
        require($smarty_dir.'/libs/Smarty.class.php');
        $smarty = new Smarty();
        $smarty->compile_check = true;
        //$smarty->debugging = true;

        $smarty->template_dir = $smarty_dir.'templates';
        $smarty->compile_dir = $smarty_dir.'templates_c';
        $smarty->cache_dir = $smarty_dir.'cache';
        $smarty->config_dir = $smarty_dir.'configs';

//        $smarty->assign('ads',$this);
        $smarty->assign('ads',$this->GetAdsArray());
        $smarty->assign('err_msg',$ErrorMessage);
        $smarty->assign('ad_flag',$ad_flag);
        $smarty->assign('cities',$this->GetCities());
        $smarty->assign('metro_stations',$this->GetMetro());
        $smarty->assign('categories',$this->GetCategories());
        $smarty->assign('href_self',$_SERVER['PHP_SELF']);
        $smarty->assign('ad',$ad);
//        $smarty->assign('msg_ad_status',$msg_ad_status);
        $smarty->display('index.tpl');
    }
}

