<?php

class AdsCompany extends Ads{
    protected $CompanyAttribute; // Некое свойство, характерное только для компании

    function __construct($ad) {
        parent::__construct($ad);
        $this->private = 1;
    }
}

?>