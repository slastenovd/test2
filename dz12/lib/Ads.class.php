<?php

class Ads{
    protected $ad_id;
//    protected $private;
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
        foreach ($ad as $key => $value) {
            $this->$key = $value;
        }
        if (!isset($this->allow_mails)) {
            $this->allow_mails = 0;
        }
    }

    public function save() {
        global $db;
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if( is_null($value) ) unset($vars[$key]);
        }
        $db->query('REPLACE INTO ads(?#) VALUES(?a)',  array_keys($vars),  array_values($vars));
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
