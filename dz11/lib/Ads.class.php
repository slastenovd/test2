<?php

class Ads {
    protected $ads = Array();
    public $Connect;

    function __construct($Connect) {
        $this->Connect = $Connect;
    }

    public function SaveAd(ad $ad){ 
        if( isset($ad->ad_id) and $ad->ad_id ){
            $this->Connect->db->query('UPDATE ads SET ?a WHERE ad_id=?',get_object_vars($ad),$ad->ad_id);
        }else{
            $this->Connect->db->query('INSERT ads SET ?a',get_object_vars($ad));
        }        
    }

    protected function ReadFromDatabase(){ // Считывает объявления из БД
        $ads_from_db = $this->Connect->db->select('SELECT * '
                . 'FROM ads '
                . 'order by date_change desc');
        unset ($this->ads);
        foreach ($ads_from_db as $value) {
            $ad = new Ad($value);
            $this->ads[$ad->ad_id] = $ad;
        }
    }
    
    protected function GetCities(){ // Загрузка данных для селектора "Города"
        return $this->Connect->db->selectCol("SELECT city_id AS ARRAY_KEY, city_name FROM cities ");
    }

    protected function GetMetro(){
        return $this->Connect->db->selectCol("SELECT metro_station_id  AS ARRAY_KEY, metro_station_name FROM metro_stations");
    }

    protected function GetCategories(){ // Загрузка данных для селектора "Категории"

        return $this->Connect->db->selectCol('SELECT a.category_name AS ARRAY_KEY_1, b.category_id AS ARRAY_KEY_2, b.category_name '
                . 'FROM categories a left join categories b on a.category_id = b.parent_id '
                . 'WHERE a.parent_id is NULL');
    }

    public function delete_ad($ad_id){
        $this->Connect->db->query('DELETE FROM ads WHERE ad_id = ?',(int)$ad_id);
        unset( $this->ads[$ad_id] );
    }

    public function ShowForm($smarty, $param = -1, $ErrorMessage = false){ // Открывает web форму
        // $param = -1 Новое объявление
        // $param >= 0 Показать объявление
        // $param является объектом класса ad : отредактировать объявление
        
        $this->ReadFromDatabase();
        $ad_flag = 0;
        
        if( isset($param) and ($param instanceof Ad) ){ // Если в качестве параметра передано объявление 
            $ad = $param;
            $ad_flag = 1;
        } elseif( isset($this->ads[(int)$param]) ){     // Если в качестве параметра передан номер объявления
            $ad = $this->ads[(int)$param]; 
            $ad_flag = 2;
        } else {
            $ad = new Ad(Array());
        }

        $smarty->assign('ads',$this->ads);
        $smarty->assign('err_msg',$ErrorMessage);
        $smarty->assign('ad_flag',$ad_flag);
        $smarty->assign('cities',$this->GetCities());
        $smarty->assign('metro_stations',$this->GetMetro());
        $smarty->assign('categories',$this->GetCategories());
        $smarty->assign('href_self',$_SERVER['PHP_SELF']);
        $smarty->assign('ad',$ad);
        $smarty->display('index.tpl');
    }
}


?>