<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

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
    

    public function ArrayToAd($ad_array){ 
        $this->ad_id=$ad_array['ad_id'];
        $this->private=$ad_array['private'];
        $this->seller_name=$ad_array['seller_name'];
        $this->manager=$ad_array['manager'];
        $this->email=$ad_array['email'];
        $this->allow_mails=$ad_array['allow_mails'];
        $this->phone=$ad_array['phone'];
        $this->location_id=$ad_array['location_id'];
        $this->metro_id=$ad_array['metro_id'];
        $this->category_id=$ad_array['category_id'];
        $this->title=$ad_array['title'];
        $this->description=$ad_array['description'];
        $this->price=$ad_array['price'];
        $this->date_change=$ad_array['date_change'];
    }

    public function AdToArray(){
        $ad = Array();
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
        return $ad;
    }
    public function ReadFromDatabase( $id ){
        
    }
}

class ads {
    protected $ads = Array();
    protected $db;
    protected $ini_file_name = 'db.ini';

    function __construct() {
        $this->Connect();
        $this->ReadFromDatabase();
    }
    public function Connect(){
        if (! $ini_array = $this->get_params_from_ini_file() ){
            echo 'Отсутствует '.$this->ini_file_name.' файл. Перейдите к <a href="install.php">установке</a>';
            exit;
        }
        $this->db = DbSimple_Generic::connect('mysqli://'.$ini_array['UserName'].':'.$ini_array['Password'].'@'.$ini_array['ServerName'].'/'.$ini_array['Database']);
    }

    public function AddNewAd(ad $ad){
        $this->ads[] = $ad;
    }

    protected function ReadFromDatabase(){
        $ads_from_db = $this->db->select('SELECT * '
                . 'FROM ads '
                . 'order by date_change desc');
        foreach ($ads_from_db as $key => $value) {
            $ad = new ad();
            $ad->ArrayToAd($value);
            $this->AddNewAd($ad);
        }
    }
    
    public function getAd ($ad_id){
        return $ads[$ad_id];
    }

    public function get_params_from_ini_file() { // Возвращает ассоциативный массив с параметрами подключения к БД
        $ini_array = array();
        if ( file_exists($this->ini_file_name) ) {
            foreach (explode(';', file_get_contents($this->ini_file_name)) as $value) {
                $ini_array[trim(substr($value, 0, strpos($value, '=')))] = trim(substr($value, strpos($value, '=') + 1));
            }
        } else{
            return false;
        }
        return $ini_array;
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
    
    protected function GetAdsArray(){
        $ads = Array();
        foreach ($this->ads as $key => $value) {
            $ads[] = $value->AdToArray();
        }
        return $ads;
    }

    public function ShowForm(){
        $err_msg = '';
        $ad_flag = 0;
        $msg_ad_status = '';
        $ad = $this->ads[0]->AdToArray();
        
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
        $smarty->assign('msg_ad_status',$msg_ad_status);

        $smarty->display('index.tpl');
    }
}

$aaa = new ads();
$aaa->ShowForm();
//print_r($aaa);