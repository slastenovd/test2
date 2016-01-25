<?php

class Ads{
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
    
    public static function delete($ad_id) {
        global $db;
        $db->query('DELETE FROM ads WHERE ad_id = ?',(int)$ad_id);
    }    
    
    public function getId() {
        return $this->ad_id;
    }

}

?>