<?php

class Ads{
    protected $ad_id;
    protected $private;
    protected $seller_name;
    protected $manager;
    protected $email;
    protected $allow_mails;
    protected $phone;
    protected $location_id;
    protected $metro_id;
    protected $category_id;
    protected $title;
    protected $description;
    protected $price;
    protected $date_change;
    
    public function __construct( $ad=Array() ) {

        if ( isset($ad['ad_id']) )          $this->ad_id = $ad['ad_id'];
        if ( isset($ad['seller_name']) )    $this->seller_name = $ad['seller_name'];
        if ( isset($ad['manager']) )        $this->manager = $ad['manager'];
        if ( isset($ad['allow_mails']) )    $this->allow_mails = $ad['allow_mails']; else $this->allow_mails = 0;
        if ( isset($ad['phone']) )          $this->phone = $ad['phone'];
        if ( isset($ad['location_id']) )    $this->location_id = $ad['location_id'];
        if ( isset($ad['metro_id']) )       $this->metro_id = $ad['metro_id'];
        if ( isset($ad['category_id']) )    $this->category_id = $ad['category_id'];
        if ( isset($ad['title']) )          $this->title = $ad['title'];
        if ( isset($ad['description']) )    $this->description = $ad['description'];
        if ( isset($ad['price']) )          $this->price = $ad['price'];
        if ( isset($ad['date_change']) )    $this->date_change = $ad['date_change'];
    }

    public function save() {
        global $db;
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if( is_null($value) ) unset($vars[$key]);
        }
        if ( $this->getId() > 0){
            $db->query('REPLACE INTO ads(?#) VALUES(?a)',  array_keys($vars),  array_values($vars));
        } else {
            $this->ad_id = $db->query('INSERT INTO ads(?#) VALUES(?a)',  array_keys($vars),  array_values($vars));
        }
        return $this;
    }
    
    public function refresh($id=0) {
        global $db;
        if ( $id === 0 ) $id=$this->getId();
        $this->__construct($db->selectRow('SELECT * FROM ads WHERE ad_id=?',$id));
    }
    public function getAdArray(){
        return get_class_vars($this);
    }
    
    public static function delete($ad_id) {
        global $db;
        $db->query('DELETE FROM ads WHERE ad_id = ?',(int)$ad_id);
    }    
    
    public function getId() {
        return $this->ad_id;
    }
    
    public function getPrivate() {
        return $this->private;
    }
    
    public function getSeller_name() {
        return $this->seller_name;
    }
    
    public function getManager() {
        return $this->manager;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getAllow_mails() {
        return $this->allow_mails;
    }
    
    public function getPhone() {
        return $this->phone;
    }
    
    public function getLocation_id() {
        return $this->location_id;
    }
    
    public function getMetro_id() {
        return $this->metro_id;
    }
    
    public function getCategory_id() {
        return $this->category_id;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function getPrice() {
        return $this->price;
    }

    public function getDate_change() {
        return $this->date_change;
    }
}
?>
