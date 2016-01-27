<?php

class AdsPrivatePerson extends Ads{
    protected $PrivateAttribute; // Некое свойство, характерное только для частного лица
    
    function __construct($ad) {
        parent::__construct($ad);
        $this->private = 0;
    }
}

?>