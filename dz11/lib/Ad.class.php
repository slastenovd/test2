<?php
class Ad {
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

}
?>