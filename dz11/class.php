<?php

require_once "FirePHPCore/FirePHP.class.php";
require_once "dbsimple/DbSimple/Generic.php";
require_once "dbsimple/config.php";
require_once "functions.php";

$firePHP = FirePHP::getInstance(true);
$firePHP->setEnabled(true);

class ad {
    public $ad_id;
    public $private;
    public $seller_name;
    public $manager;
    public $email;
    public $allow_mails;
    public $phone;
    public $location_id;
    public $metro_id;
    public $category_id;
    public $title;
    public $description;
    public $price;
    public $date_change;
    
    public $CheckResult = false;
    

    public function ArrayToAd($ad_array){ 
        if ( isset($ad_array['ad_id']) )        $this->ad_id=$ad_array['ad_id'];
        if ( isset($ad_array['private']) )      $this->private=$ad_array['private'];
        if ( isset($ad_array['seller_name']) )  $this->seller_name=$ad_array['seller_name'];
        if ( isset($ad_array['manager']) )      $this->manager=$ad_array['manager'];
        if ( isset($ad_array['email']) )        $this->email=$ad_array['email'];
        if ( isset($ad_array['allow_mails']) )  $this->allow_mails=$ad_array['allow_mails']; else $this->allow_mails = 0;
        if ( isset($ad_array['phone']) )        $this->phone=$ad_array['phone'];
        if ( isset($ad_array['location_id']) )  $this->location_id=$ad_array['location_id'];
        if ( isset($ad_array['metro_id']) )     $this->metro_id=$ad_array['metro_id'];
        if ( isset($ad_array['category_id']) )  $this->category_id=$ad_array['category_id'];
        if ( isset($ad_array['title']) )        $this->title=$ad_array['title'];
        if ( isset($ad_array['description']) )  $this->description=$ad_array['description'];
        if ( isset($ad_array['price']) )        $this->price=$ad_array['price'];
        if ( isset($ad_array['date_change']) )  $this->date_change=$ad_array['date_change'];
//        if ( !isset($ad_array['allow_mails']) ) $this->allow_mails = 0; // Если чекбокс не нажат то в POST не отправляется никакого значения. В этом случае установка значения в 0
        
    }

    public function AdToArray(){
        $ad_array = Array();
        $ad_array['ad_id'] = $this->ad_id;
        $ad_array['private'] = $this->private;
        $ad_array['seller_name'] = $this->seller_name;
        $ad_array['manager'] = $this->manager;
        $ad_array['email'] = $this->email;
        $ad_array['allow_mails'] = $this->allow_mails;
        $ad_array['phone'] = $this->phone;
        $ad_array['location_id'] = $this->location_id;
        $ad_array['metro_id'] = $this->metro_id;
        $ad_array['category_id'] = $this->category_id;
        $ad_array['title'] = $this->title;
        $ad_array['description'] = $this->description;
        $ad_array['price'] = $this->price;
        $ad_array['date_change'] = $this->date_change;
        
        return $ad_array;
    }
    public function Check(){
        $this->CheckResult = false;
        if (isset($this->title) and ! strlen($this->title)) { // Если значение приянто, однако оно пустое
            $this->CheckResult .= 'Не заполнено поле Название объявления<br>';
        }

        if (isset($this->seller_name) and ! strlen($this->seller_name)) { // Если значение приянто, однако оно пустое
            $this->CheckResult .= 'Не заполнено поле Ваше имя<br>';
        }

        if (isset($this->price) and $this->price == 0) { // Если значение приянто, однако оно пустое
            $this->CheckResult .= 'Не заполнено поле Цена<br>';
        }
        return $this->CheckResult;
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
            $ad = new ad();
            $ad->ArrayToAd($value);
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
            $ads[$value->ad_id] = $value->AdToArray();
        }
        return $ads;
    }
    
    public function delete_ad($ad_id){
        $this->db->query('DELETE FROM ads WHERE ad_id = ?',(int)$ad_id);
        unset( $this->ads[$ad_id] );
        return $this->db->affected_rows;
    }

    public function ShowForm($param = -1){ // Открывает web форму
        // $param = -1 Новое объявление
        // $param >= 0 Показать объявление
        // $param является объектом класса ad : отредактировать объявление
        
        $this->ReadFromDatabase();
        $ad = Array();
        $err_msg = '';
        $ad_flag = 0;
//        $msg_ad_status = '';
        
        if( isset($param) and ($param instanceof ad) ){ // Если в качестве параметра передано объявление 
            $ad = $param->AdToArray();
            $err_msg = $param->CheckResult;
            $ad_flag = 1;
        } elseif( isset($this->ads[(int)$param]) ){     // Если в качестве параметра передан номер объявления
            $ad = $this->ads[(int)$param]->AdToArray(); 
            $ad_flag = 2;
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

        $smarty->assign('ads',$this->GetAdsArray());
        $smarty->assign('err_msg',$err_msg);
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

