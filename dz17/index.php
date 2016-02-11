<?php
require_once "prepare.php";

AdsStore::instance()->getAllAdsFromDb()->prepareForOut()->display();
