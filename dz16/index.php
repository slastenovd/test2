<?php
require_once "prepare.php";

$adStore =  AdsStore::instance()->getAllAdsFromDb()->prepareForOut()->display();
