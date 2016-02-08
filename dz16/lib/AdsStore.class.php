<?php

class AdsStore{
    private static $instance=NULL;
    private $ads=array();
    
    public static function instance() {
        if(self::$instance == NULL){
            self::$instance = new AdsStore();
        }
        return self::$instance;
    }
    public function addAds(Ads $ad) {
        if(!($this instanceof AdsStore)){
            die('Нельзя использовать этот метод в конструкторе классов');
        }
        $this->ads[$ad->getId()]=$ad;
    }
    
    public function getAllAdsFromDb() {
        global $db;
        $all = $db->select('select * from ads order by date_change desc');
        foreach ($all as $value){
            if( $value['private'] == 1 ){ 
                $ad = new AdsCompany($value);
            } else {
                $ad = new AdsPrivatePerson($value);
            }
            self::addAds($ad);//помещаем объект в хранилище
        }
        return self::$instance;
    }
    
    public static function deleteAds($ad_id) {
        global $db;
//        $db->query("DELETE FROM ads WHERE ad_id = ?",(int)$ad_id);
        unset(self::instance()->ads[$ad_id]);
        return $db->query("DELETE FROM ads WHERE ad_id = ?",(int)$ad_id);
    }    
    
    protected function GetCities(){ // Загрузка данных для селектора "Города"
        global $db;
        return $db->selectCol("SELECT city_id AS ARRAY_KEY, city_name FROM cities ");
    }

    protected function GetMetro(){
        global $db;
        return $db->selectCol("SELECT metro_station_id  AS ARRAY_KEY, metro_station_name FROM metro_stations");
    }

    protected function GetCategories(){ // Загрузка данных для селектора "Категории"
        global $db;
        return $db->selectCol('SELECT a.category_name AS ARRAY_KEY_1, b.category_id AS ARRAY_KEY_2, b.category_name '
                . 'FROM categories a left join categories b on a.category_id = b.parent_id '
                . 'WHERE a.parent_id is NULL');
    }    
    
    public function prepareForOut($param = -1, $ErrorMessage = false) {
        // $param = -1 Новое объявление
        // $param >= 0 Показать объявление
        // $param является объектом класса ad : отредактировать объявление
        
        $ad_flag = 0;

        if( isset($param) and ($param instanceof Ads) ){ // Если в качестве параметра передано объявление 
            $ad = $param;
            $ad_flag = 1;
        } elseif( isset($this->ads[(int)$param]) ){     // Если в качестве параметра передан номер объявления
            $ad = $this->ads[(int)$param]; 
            $ad_flag = 2;
        } else {
            $ad = new Ads(Array());
        }
        if( !isset($this->ads) ) $this->ads = Array();

        global $smarty;
        $smarty->assign('href_self',$_SERVER['PHP_SELF']);

        $row='';
        $SliderIndicators='';
        $SliderItems='';
        $SliderItemNumber = 0;
        foreach ($this->ads as $value) {
            $smarty->assign('ad',$value);
            $row.=$smarty->fetch('table_row.tpl.html');

//            if( ($value->getPrivate() == 1 and $SliderItemNumber < 4){
//            // так компании - классные ребята и платят много денег, поместим объявления компаний в слайдер
//                $smarty->assign('SliderItemNumber',$SliderItemNumber);
//                $smarty->assign('CarouselMsg',$value->getTitle().' за '.$value->getPrice().' руб');
//                $smarty->assign('ad',$value);
//                
//                $SliderIndicators.=$smarty->fetch('carousel_indicators.tpl.html');
//                $SliderItems.=$smarty->fetch('carousel_items.tpl.html');
//                $SliderItemNumber++;
//            }
        }
        
        $smarty->assign('ads_rows',$row);
        $smarty->assign('SliderIndicators',$SliderIndicators);
        $smarty->assign('SliderItems',$SliderItems);

        $smarty->assign('ads',$this->ads);
        $smarty->assign('err_msg',$ErrorMessage);
        $smarty->assign('ad_flag',$ad_flag);
        
        $smarty->assign('cities',$this->GetCities());
        $smarty->assign('metro_stations',$this->GetMetro());
        $smarty->assign('categories',$this->GetCategories());

        $smarty->assign('ad',$ad);       
        
        return self::$instance;    
    }
    public function display() {
        global $smarty;
        $smarty->display('index.tpl');
    }
}
?>